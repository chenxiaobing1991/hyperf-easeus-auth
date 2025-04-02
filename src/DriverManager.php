<?php

namespace Cxb\Hyperf\Easeus\Auth;

use Cxb\Hyperf\Easeus\Auth\Driver\DefaultDriver;
use Cxb\Hyperf\Easeus\Auth\Driver\DriverInterface;
use Cxb\Hyperf\Easeus\Auth\Exception\Exception;
use function Hyperf\Support\make;

/**
 * Class DriverManager
 * @package Cxb\Hyperf\Easeus\Auth
 * @method parseToken()
 * @method parseAppId()
 * @method parseMenuCode()
 */
class DriverManager
{
    private $driver = DefaultDriver::class;
    private $model;

    public function __construct()
    {
        $driver !== null && $this->driver = $driver;
        $this->model = make($this->driver);
    }

    /**
     * @param $method
     * @param mixed $args
     */
    public function __call($method, $args)
    {
        if (!$this->model instanceof DriverInterface)
            throw new Exception("Does not support this driver: {$this->driver}");
        return call_user_func([$this->model, $method], ...$args);
    }
}