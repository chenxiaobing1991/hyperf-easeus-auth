<?php


namespace Cxb\Hyperf\Easeus\Auth;

/**
 * Interface ProviderInterface
 * @package Cxb\Hyperf\Easeus\Auth
 */
interface ProviderInterface
{
    public function parseToken(): ?string;//获取token

    public function parseAppKey(): string;//应用秘钥

    public function parseAccessToken(): string;//通用授权令牌
}