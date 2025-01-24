<?php


namespace Cxb\Hyperf\Easeus\Auth\Provider;


use Cxb\Hyperf\Easeus\Auth\AbstractProvider;

/**
 * 账号管理
 * Class UserProvider
 * @package Cxb\Hyperf\Easeus\Auth\Provider
 */
class UserProvider extends AbstractProvider
{
    
    /**
     * 获取员工账号
     * @param $id
     */
    public function info($id)
    {
        return $this->request('/api/v1/base/user/info?'.http_build_query(['id'=>$id]),'get');
    }
    

    /**
     * 员工列表
     * @param array $map
     */
    public function list(array $map = [])
    {
        return $this->request('/api/v1/base/user/list?'.http_build_query($map),'get');
    }
}