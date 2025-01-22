<?php


namespace Cxb\Hyperf\Easeus\Auth;


use Hyperf\Contract\ConfigInterface;

/**
 * Class ApplicationFactory
 * @package App\Component\Admin\src
 */
final class ApplicationFactory
{
    private $name = 'default';//默认引擎名
    private array $drivers = [];

    /**
     * 实例化容器实例
     * ApplicationFactory constructor.
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        foreach ($config->get('auth') as $name => $info) {
            $this->drivers[$name] = make(Application::class, ['config' => new Config($info)]);//中间件处理
        }
    }

    /**
     *
     * @param string $name
     * @return mixed
     * @throws \Exception
     */
    public function get(string $name)
    {
        if (!isset($this->drivers[$name]))
            throw new \Exception('不存在的引擎内容');
        return $this->drivers[$name];
    }

    /**
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function __get($name)
    {
        return $this->get($this->name);
    }
}