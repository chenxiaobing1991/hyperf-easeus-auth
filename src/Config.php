<?php


namespace Cxb\Hyperf\Easeus\Auth;

use Cxb\Hyperf\Easeus\Auth\Driver\DefaultDriver;
use Cxb\Hyperf\Easeus\Auth\Driver\DriverInterface;
use function Hyperf\Support\make;

/**
 * Class Config
 * @package Cxb\Hyperf\Easeus\Auth
 */
final class Config
{

    public function __construct(private $config = [])
    {
        isset($config['address']) && $this->address = (string)$config['address'];
        $this->driver = isset($config['driver']) ? $config['driver'] : make(DefaultDriver::class);
    }

    /**
     * 获取链接地址
     * @return string
     */
    public function getAddress(): string
    {
        return rtrim((string)($this->config['address'] ?? ''), '/');
    }

    /**
     * @return mixed
     */
    public function driver(): ProviderInterface
    {
        return $config['driver'];
    }
}