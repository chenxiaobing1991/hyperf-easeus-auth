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
abstract class AbstractDriver
{
    protected const STATUS_SUCCESS = 0;

    protected const STATUS_ERROR = -1;

    /**
     * AbstractDriver constructor.
     * @param GuardManager $app
     * @param Config $config
     */
    public function __construct(protected GuardManager $app, protected Config $config)
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

        $header = array_merge([
            'Authorization' => 'Bearer ' . $this->config->driver()->parseToken(),
            'app-key' => $this->config->driver()->parseAppKey(),
            'AccessToken' => $this->config->driver()->parseAccessToken()
        ], $header);
        $request = new RequestClient($method, $this->config->getAddress() . $uri, is_array($params) ? json_encode($params, true) : $params, $header);
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
        $body = json_decode($response->body, true);
        if ($body['code'] != self::STATUS_SUCCESS)
            throw new Exception($body['message'], (int)$body['code']);
        return $body['data'] ?? null;
    }
}