<?php


namespace Cxb\Hyperf\Easeus\Auth;

use Cxb\Hyperf\Easeus\Auth\Driver\DriverInterface;
use Cxb\Hyperf\Easeus\Auth\Exception\Exception;
use Cxb\Hyperf\Easeus\Auth\Exception\HttpException;
use Cxb\GuzzleHttp\ResponseClient;
use Psr\Container\ContainerInterface;
use Cxb\GuzzleHttp\RequestClient;
use Cxb\GuzzleHttp\ClientFactory;

/**
 * 封装
 * Class AbstractProvider
 * @package App\Component\Admin\src
 */
abstract class AbstractProvider
{
    public function __construct(protected GuardManager $app, protected Config $config,protected DriverManager $driver)
    {

    }

    /**
     * 参数请求
     * @param string $uri
     * @param $method
     * @param null $params
     * @param array $header
     */
    protected function request(string $uri, $method, $params = null, array $header = [])
    {
        $header = array_merge(['Authorization' => 'Bearer ' . $this->driver->token()], $header);//封装token
        print_r($method);
        $request = new RequestClient($method, $this->config->getUri() . $uri, is_array($params) ? json_encode($params, true) : $params, $header);
        return $this->handleResponse(ClientFactory::send($request));
    }

    /**
     * @param ResponseClient $response
     * @return
     */
    protected function handleResponse(ResponseClient $response)
    {
        if ($response->statusCode != 200)
            throw new HttpException($response->statusCode, $response->error);
        $body = json_decode($response->body,true);
        if ($body['code'] != ListEnum::STATUS_SUCCESS)
            throw new Exception($body['message'], (int)$body['code']);
        return $body['data'] ?? null;
    }
}