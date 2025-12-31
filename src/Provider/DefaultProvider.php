<?php
declare(strict_types=1);

namespace Cxb\Hyperf\Easeus\Auth\Provider;

use Cxb\Hyperf\Easeus\Auth\ProviderInterface;
use Hyperf\Di\Annotation\Inject;
use Psr\Http\Message\ServerRequestInterface;
use Hyperf\Stringable\Str;

/**
 * Class DefaultProvider
 * @package Cxb\Hyperf\Easeus\Auth\Provider
 */
class DefaultProvider implements ProviderInterface
{
    protected mixed $headerName = 'Authorization';
    #[Inject]
    protected ServerRequestInterface $request;

    /**
     * @return string|null
     */
    public function parseToken(): ?string
    {
        $header = $this->request->hasHeader($this->headerName) ? $this->request->getHeaderLine($this->headerName) : null;
        if (Str::startsWith($header, 'Bearer ')) {
            return Str::substr($header, 7);
        }
        return null;
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