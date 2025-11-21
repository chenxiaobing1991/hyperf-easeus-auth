<?php


namespace Cxb\Hyperf\Easeus\Auth\Driver\v2;


use Cxb\Hyperf\Easeus\Auth\AbstractDriver;

/**
 * 权限模块
 * Class PermissionDriver
 * @package Cxb\Hyperf\Easeus\Auth\Driver\v2
 */
class PermissionDriver extends AbstractDriver
{
    /**
     * 权限用户列表
     * @param array $map
     */
    public function users(array $map = [])
    {
        return $this->request('/api/v2/permission/role-user/list', 'GET');
    }

    /**
     * 权限菜单
     * @return array
     */
    public function menus()
    {
        return $this->request('/api/v2/permission/menus', 'GET');
    }

    /**
     * 我的角色
     * @return mixed|null
     */
    public function roles()
    {
       return  $this->request('/api/v2/permission/roles', 'GET');
    }
}