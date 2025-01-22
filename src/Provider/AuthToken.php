<?php


namespace Cxb\Hyperf\Easeus\Auth\Provider;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Stringable\Str;

/**
 *
 * class AuthToken
 * @package App\Component\Admin\src\Provider
 */
 trait AuthToken
{
     protected mixed $headerName = 'Authorization';

     /**
      * 获取token
      * @return string|null
      */
     public function token():?string{
         $request=$this->container->get(RequestInterface::class);
         $header = $request->header($this->headerName, '');
         if (Str::startsWith($header, 'Bearer ')) {
             return Str::substr($header, 7);
         }
         if ($request->has('token')) {
             return $request->input('token');
         }
         return null;
     }
}