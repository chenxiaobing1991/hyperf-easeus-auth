<?php


namespace Cxb\Hyperf\Easeus\Auth\Provider\v1;


use Cxb\Hyperf\Easeus\Auth\AbstractDriver;

/**
 * Class MyDriver
 * @package Cxb\Hyperf\Easeus\Auth\Provider\v1
 */
class MyDriver extends AbstractDriver
{
    /**
     * 获取个人信息
     */
    public function info()
    {
        return $this->request('/api/v1/base/user/my/info', 'GET');
    }
}