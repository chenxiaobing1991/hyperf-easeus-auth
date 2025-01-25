<?php


namespace Cxb\Hyperf\Easeus\Auth;

use Cxb\Hyperf\Easeus\Auth\Driver\DefaultDriver;
use Cxb\Hyperf\Easeus\Auth\Driver\DriverInterface;

/**
 * Class Config
 * @package App\Component\Admin\src
 */
final class Config
{
    private string $address;
    private $driver=DefaultDriver::class;
    public function __construct(array $config = [])
    {
        isset($config['address']) && $this->address = (string)$config['address'];
        isset($config['driver']) && $this->driver =$config['driver'];
    }

    /**
     * 获取链接地址
     * @return string
     */
    public function getAddress(): string
    {
        return rtrim($this->address, '/');
    }

    /**
     * @return mixed
     */
    public function getDriver(){
        return $this->driver;
    }
}