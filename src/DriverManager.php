<?php

namespace Cxb\Hyperf\Easeus\Auth;

use Cxb\Hyperf\Easeus\Auth\Driver\DefaultDriver;
use Cxb\Hyperf\Easeus\Auth\Driver\DriverInterface;
use Cxb\Hyperf\Easeus\Auth\Exception\Exception;

/**
 * Class DriverManager
 * @package Cxb\Hyperf\Easeus\Auth
 */
class DriverManager
{
    private $driver = DefaultDriver::class;
    private $model;

    public function __construct(array $config = [])
    {
        isset($config['driver']) && $this->driver = $config['driver'];
        $this->model = make($this->driver);
    }

    /**
     * @return string
     */
    public function token()
    {
        if (!$this->model instanceof DriverInterface)
            throw new Exception("Does not support this driver: {$name}");
        return $this->model->parseToken();
    }
}