<?php


namespace Cxb\Hyperf\Easeus\Auth\Driver;

/**
 * Interface DriverInterface
 * @package Cxb\Hyperf\Easeus\Auth\Driver
 */
interface DriverInterface
{
   public function parseToken():?string;//获取token

   public function parseAppId():string;//应用编号
   public function parseMenuCode():string;
}