<?php


namespace Cxb\Hyperf\Easeus\Auth;

use Cxb\Hyperf\Easeus\Auth\Driver\DefaultDriver;
use Cxb\Hyperf\Easeus\Auth\Driver\DriverInterface;
use function Hyperf\Support\make;

/**
 * Class Config
 * @package App\Component\Admin\src
 */
final class Config
{
    private string $address;
    private $driver;

    public function __construct(array $config = [])
    {
        isset($config['address']) && $this->address = (string)$config['address'];
        $this->driver = isset($config['driver']) ? $config['driver'] : DefaultDriver::class;
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
    public function driver(): DriverInterface
    {
        return make($this->driver);
    }
}