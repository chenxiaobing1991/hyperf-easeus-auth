<?php


namespace Cxb\Hyperf\Easeus\Auth\Provider;


use Cxb\Hyperf\Easeus\Auth\AbstractProvider;

/**
 * Class MyProvider
 * @package App\Component\Admin\src\Provider
 */
class MyProvider extends AbstractProvider
{
    /**
     * 获取个人信息
     */
    public function info()
    {
        return $this->request('/api/v1/base/user/my/info', 'GET');
    }
    /**
     * 获取绑定角色
     */
    public function role()
    {
        return $this->request('/api/v1/base/user/my/role', 'GET');
    }
}