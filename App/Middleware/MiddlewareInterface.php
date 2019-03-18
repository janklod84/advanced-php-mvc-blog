<?php 
namespace App\Middleware;


use System\Application;

/**
 * @package \App\Middleware\MiddlewareInterface
*/
interface MiddlewareInterface
{
       
       /**
        * Handle the middleware
        * 
        * @param \System\Application $app
        * @param string $next
        * @return mixed
       */
       public function handle(Application $app, $next);
}