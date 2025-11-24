<?php


namespace Cxb\Hyperf\Easeus\Auth\Driver\v2;


use Cxb\Hyperf\Easeus\Auth\AbstractDriver;

/**
 * 权限模块
 * Class UserRoleDriver
 * @package Cxb\Hyperf\Easeus\Auth\Driver\v2
 */
class UserRoleDriver extends AbstractDriver
{
    /**
     * 用户角色
     * @param mixed $user_id
     */
    public function roles(mixed $user_id)
    {
        return $this->request('/api/v2/permission/user-role/role-list?user_id=' . $user_id, 'GET');
    }
}