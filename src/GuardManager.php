<?php


namespace Cxb\Hyperf\Easeus\Auth;


use Cxb\Hyperf\Easeus\Auth\Driver\DriverInterface;
use Cxb\Hyperf\Easeus\Auth\Provider\MyProvider;
use Cxb\Hyperf\Easeus\Auth\Provider\UserProvider;
use function Hyperf\Support\make;
/**
 * 中间件调度引擎
 * Class Application
 * @package App\Component\Admin\src
 */
final class GuardManager
{
    protected $alias = [
        'self' => MyProvider::class,
        'user' => UserProvider::class
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
        if (!isset($this->alias[$name]))
            throw new \Exception('不存在的引擎');
        return $this->providers[$name] = make($this->alias[$name], ['app' => $this, 'config' => $this->config]);
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


}