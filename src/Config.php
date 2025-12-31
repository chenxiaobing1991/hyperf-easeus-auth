<?php


namespace Cxb\Hyperf\Easeus\Auth;

use Cxb\Hyperf\Easeus\Auth\Driver\DefaultDriver;
use Cxb\Hyperf\Easeus\Auth\Driver\DriverInterface;
use Cxb\Hyperf\Easeus\Auth\Provider\DefaultProvider;
use function Hyperf\Support\make;

/**
 * Class Config
 * @package Cxb\Hyperf\Easeus\Auth
 */
final class Config
{

    public function __construct(private $config = [])
    {
    }

    /**
     * 获取链接地址
     * @return string
     */
    public function getAddress(): string
    {
        return rtrim((string)$this->get('address'), '/');
    }

    /**
     * @return mixed
     */
    public function provider(): ProviderInterface
    {
        $driver = $this->get('driver');
        return $driver instanceof ProviderInterface ? $driver : make(DefaultProvider::class);
    }

    /**
     * @return string
     */
    public function getAppKey(): string
    {
        $provider = $this->provider();
        return (string)(!empty($provider->parseAppKey()) ? $provider->parseAppKey() : $this->get('app_key'));
    }

    /**
     * @return string
     */
    public function parseToken(): string
    {
        return (string)$this->provider()->parseToken();
    }

    /**
     * @return string
     */
    public function parseAccessToken(): string
    {
        return (string)$this->provider()->parseAccessToken();
    }

    /**
     * @param string $name
     * @param null $default
     * @return mixed|null
     */
    public function get(string $name, $default = null)
    {
        return $this->config[$name] ?? $default;
    }
}