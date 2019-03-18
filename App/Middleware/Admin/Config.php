<?php 
namespace App\Middleware\Admin;

use System\Application;
use App\Middleware\MiddlewareInterface;


class Config implements MiddlewareInterface
{
        
          /**
	        * Handle the middleware
	        * 
	        * @param \System\Application $app
	        * @param string $next
	        * @return mixed
         */
         public function handle(Application $app, $next)
         {
         	    // die('Config Middleware');
         	
                // share admin layout
			    $app->share('adminLayout', function ($app) {
			        return $app->load->controller('Admin/Common/Layout');
			    });

         	    return $next;
         }
}