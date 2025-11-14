<?php


namespace Cxb\Hyperf\Easeus\Auth\Driver\v2;


use Cxb\Hyperf\Easeus\Auth\AbstractDriver;

/**
 * Class RoleDriver
 * @package Cxb\Hyperf\Easeus\Auth\Driver\v2
 */
class RoleDriver extends AbstractDriver
{
    /**
     * 角色详情
     * @param $id
     */
    public function info($id)
    {
        return $this->request('/api/v2/base/role/info?' . http_build_query(['role_id' => $id]), 'get');
    }


    /**
     * 角色列表
     * @param array $map
     */
    public function list(array $map = [])
    {
        return $this->request('/api/v2/base/role/list?' . http_build_query($map), 'get');
    }
}