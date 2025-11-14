<?php
declare(strict_types=1);

namespace Cxb\Hyperf\Easeus\Auth\Provider;
/**
 * Class DefaultProvider
 * @package Cxb\Hyperf\Easeus\Auth\Provider
 */
class DefaultProvider implements \Cxb\Hyperf\Easeus\Auth\ProviderInterface
{
    /**
     * @return string|null
     */
    public function parseToken(): ?string
    {
        return '';
    }

    public function parseAppKey(): string
    {
        return '';
    }

    public function parseAccessToken(): string
    {
        return '';
    }
}