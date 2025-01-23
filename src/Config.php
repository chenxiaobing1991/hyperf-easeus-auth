<?php


namespace Cxb\Hyperf\Easeus\Auth;

/**
 * Class Config
 * @package App\Component\Admin\src
 */
final class Config
{
    private string $uri;

    public function __construct(array $config = [])
    {
        isset($config['uri']) && $this->uri = (string)$config['uri'];
    }

    /**
     * 获取链接地址
     * @return string
     */
    public function getUri(): string
    {
        return rtrim($this->uri, '/');
    }
}