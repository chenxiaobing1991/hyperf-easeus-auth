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
    public function driver(): ProviderInterface
    {
        $driver = $this->get('driver');
        return $driver instanceof ProviderInterface ? $driver : make(DefaultProvider::class);
    }

    /**
     * @return string
     */
    public function getAppKey(): string
    {
        return $this->get('app_key');
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