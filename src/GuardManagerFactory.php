<?php


namespace Cxb\Hyperf\Easeus\Auth;


use Cxb\Hyperf\Easeus\Auth\Exception\Exception;
use Hyperf\Contract\ConfigInterface;
use function Hyperf\Support\make;

/**
 * Class ApplicationFactory
 * @package App\Component\Admin\src
 */
class GuardManagerFactory
{
    protected array $config;
    protected array $guards = [];//实例化引擎

    /**
     *
     * ApplicationFactory constructor.
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $values = $config->get('auth');
        $this->config = isset($values) && is_array($values) ? $values : [];
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
    public function config()
    {
        return $this->config;
    }


    /**
     * @param string|null $name
     * @return GuardManager|mixed
     */
    public function guard(string $name = null)
    {
        $name = $name ?? $this->defaultGuard();
        if (isset($this->guards[$name]))
            return $this->guards[$name];
        if (!isset($this->config()['guards'][$name]))
            throw new Exception("Does not support this guard: {$name}");
        $config = new Config($this->config()['guards'][$name]);
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
        return $this->config['guard'] ?? 'default';
    }
}