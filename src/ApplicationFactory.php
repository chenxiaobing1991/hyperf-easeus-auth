<?php


namespace Cxb\Hyperf\Easeus\Auth;


use Cxb\Hyperf\Easeus\Auth\Exception\Exception;
use Hyperf\Contract\ConfigInterface;

/**
 * Class ApplicationFactory
 * @package App\Component\Admin\src
 */
class ApplicationFactory
{
    private string $default = 'default';//默认引擎名
    protected array $config;
    protected array $guards = [];//实例化引擎
    protected bool $enable = false;

    /**
     *
     * ApplicationFactory constructor.
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config->get('auth');
        isset($this->config['enable']) && $this->enable = $this->config['enable'];
    }

    /**
     * 获取所有引擎
     * @return array
     */
    public function guards(): array
    {
        return $this->guards;
    }

    /**
     * @return array|mixed
     */
    public function getConfig()
    {
        return $this->config;
    }


    /**
     * @param string|null $name
     * @return GuardManager|mixed
     */
    public function guard(string $name = null)
    {
        if (!$this->enable)
            throw new Exception("Does  support this disabled");
        $name = $name ?? $this->defaultGuard();
        if (isset($this->guards[$name]))
            return $this->guards[$name];
        if (!isset($this->getConfig()['guards'][$name]))
            throw new Exception("Does not support this guard: {$name}");
        $config = new Config($this->getConfig()['guards'][$name]);
        return $this->guards[$name] = make(GuardManager::class, ['config' => $config]);
    }

    /**
     * 注册引擎
     * @param string $name
     * @param GuardManager $guard
     */
    public function register(string $name, GuardManager $guard)
    {
        $this->guards[$name] = $guard;
    }

    /**
     *
     * @return string
     */
    public function defaultGuard(): string
    {
        return $this->getConfig()['guard'] ?? $this->default;
    }
}