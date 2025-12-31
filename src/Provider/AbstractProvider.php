<?php


namespace Cxb\Hyperf\Easeus\Auth\Provider;


use Cxb\Hyperf\Easeus\Auth\Config;
use Cxb\Hyperf\Easeus\Auth\ProviderInterface;

abstract class AbstractProvider  implements ProviderInterface
{
    public function __construct(protected Config $config)
    {

    }
}