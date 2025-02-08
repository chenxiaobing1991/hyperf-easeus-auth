<?php

namespace Cxb\Hyperf\Easeus\Auth;

use Cxb\Hyperf\Easeus\Auth\Driver\DefaultDriver;
use Cxb\Hyperf\Easeus\Auth\Driver\DriverInterface;
use Cxb\Hyperf\Easeus\Auth\Exception\Exception;
use function Hyperf\Support\make;
/**
 * Class DriverManager
 * @package Cxb\Hyperf\Easeus\Auth
 */
class DriverManager
{
    private $driver = DefaultDriver::class;
    private $model;

    public function __construct($driver=null)
    {
        $driver!==null && $this->driver = $driver;
        $this->model = make($this->driver);
    }

    /**
     * @return string
     */
    public function token()
    {
        if (!$this->model instanceof DriverInterface)
            throw new Exception("Does not support this driver: {$this->driver}");
        return $this->model->parseToken();
    }
}