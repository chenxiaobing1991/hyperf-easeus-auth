<?php

namespace Cxb\Hyperf\Easeus\Auth\Driver;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Stringable\Str;

class DefaultDriver implements DriverInterface
{
    protected mixed $headerName = 'Authorization';

    public function __construct(protected RequestInterface $request)
    {

    }

    /**
     * @return string|null
     */
    public function parseToken(): ?string
    {
        $header = $this->request->header($this->headerName, '');
        if (Str::startsWith($header, 'Bearer ')) {
            return Str::substr($header, 7);
        }
        if ($this->request->has('token')) {
            return $this->request->input('token');
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function parseAppId(): string
    {
        return (string)$this->request->header('app-id', '');
    }

    /**
     * @return string
     */
    public function parseMenuCode(): string
    {
        return (string)$this->request->header('menu-code', '');
    }

}