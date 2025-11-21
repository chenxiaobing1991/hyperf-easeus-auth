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
     * 获取角色列表
     */
    public function roles($user_id, array $map = [])
    {
        $map['user_id'] = $user_id;
        $list = $this->request('/api/v2/permission/user-role/role-tree?' . http_build_query($map), 'GET');
        $result = [];
        foreach ($list as $info) {
            $appKey = $info['app_key'] ?? '';
            foreach ($info['children'] ?? [] as $child) {
                if (($child['selected'] ?? false))
                    $result[] = $child;
            }
        }
        return $result;
    }
}