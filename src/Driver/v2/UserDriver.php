<?php

namespace Cxb\Hyperf\Easeus\Auth\Provider\v2;

use Cxb\Hyperf\Easeus\Auth\AbstractDriver;

/**
 * Class UserDriver
 * @package Cxb\Hyperf\Easeus\Auth\Provider\v2
 */
class UserDriver extends AbstractDriver
{
    /**
     * 获取员工账号
     * @param $id
     */
    public function info($id)
    {
        return $this->request('/api/v2/base/user/info?' . http_build_query(['id' => $id]), 'get');
    }


    /**
     * 员工列表
     * @param array $map
     */
    public function list(array $map = [])
    {
        return $this->request('/api/v2/base/user/list?' . http_build_query($map), 'get');
    }

    /**
     * 
     * @return mixed|null
     */
    public function tree()
    {
        return $this->request('/api/v2/base/user/tree', 'get');
    }
}