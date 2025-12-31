<?php


namespace Cxb\Hyperf\Easeus\Auth;


use Cxb\Hyperf\Easeus\Auth\Driver\DriverInterface;
use Cxb\Hyperf\Easeus\Auth\Driver\v2\MyDriver;
use Cxb\Hyperf\Easeus\Auth\Driver\v2\UserDriver;
use Cxb\Hyperf\Easeus\Auth\Driver\v2\PermissionDriver;
use Cxb\Hyperf\Easeus\Auth\Driver\v2\RoleDriver;
use Cxb\Hyperf\Easeus\Auth\Driver\v2\UserRoleDriver;
use function Hyperf\Support\make;

/**
 * 中间件调度引擎
 * Class Application
 * @package App\Component\Admin\src
 */
final class GuardManager
{
    protected $alias = [
        'self' => MyDriver::class,
        'user' => UserDriver::class,
        'role' => RoleDriver::class,
        'permission' => PermissionDriver::class,
        'user_role' => UserRoleDriver::class
    ];
    protected $providers = [];

    public function __construct(private Config $config)
    {
    }

    /**
     * @param string $name
     */
    public function get(string $name)
    {
        if (isset($this->providers[$name]))
            return $this->providers[$name];
        $class_name = class_exists($name) ? $name : (isset($this->alias[$name]) ? $this->alias[$name] : null);
        if (!$class_name)
            throw new \Exception('不存在的引擎');
        return $this->providers[$name] = make($class_name, ['app' => $this, 'config' => $this->config]);
    }

    /**
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    public function config(): Config
    {
        return $this->config;
    }


}