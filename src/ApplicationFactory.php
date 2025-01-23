<?php


namespace Cxb\Hyperf\Easeus\Auth;


use Cxb\Hyperf\Easeus\Auth\Exception\Exception;
use Hyperf\Contract\ConfigInterface;

/**
 * Class ApplicationFactory
 * @package App\Component\Admin\src
 */
final class ApplicationFactory
{
    private string $default = 'default';//默认引擎名
    private array $config;
    protected array $guards = [];//实例化引擎
    protected array $drivers=[];
    /**
     *
     * ApplicationFactory constructor.
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config->get('auth');
    }

    /**
     * 获取引擎
     * @return array
     */
    public function guards():array{
        return $this->guards;
    }

    /**
     * @param string|null $name
     * @return GuardManager|mixed
     */
    public function guard(string $name=null){
        $name = $name ?? $this->defaultGuard();
        if(!isset($this->config['guards'][$name]))
            throw new Exception("Does not support this guard: {$name}");
        if(isset($this->guards[$name]))
            return $this->guards[$name];
        $config = new Config($this->config['guards'][$name]);
        $driver=$this->driver($name);
        return $this->guards[$name]=make(GuardManager::class,compact('driver', 'config'));
    }

    /**
     * 注册引擎
     * @param string $name
     * @param GuardManager $guard
     */
    public function register(string $name,GuardManager $guard){
        $this->guards[$name]=$guard;
    }

    /**
     * @param string|null $name
     */
    public function driver(string $name=null){
        $name = $name ?? $this->defaultDriver();
        if(isset($this->drivers[$name]))
            return $this->drivers[$name];
        return $this->drivers[$name] = make(DriverManager::class,['config'=>$this->config['drivers'][$name]??[]]);
    }
    /**
     * 默认引擎
     * @return string
     */
    public function defaultGuard(): string
    {
        return $this->config['default']['guard'] ?? $this->default;
    }

    /**
     * @return string
     */
    public function defaultDriver():string{
        return $this->config['default']['driver'] ?? $this->default;
    }
}