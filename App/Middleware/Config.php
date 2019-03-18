<?php 
namespace App\Middleware;

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
         	    // share Blog layout
                $app->share('blogLayout', function ($app) {
                    return $app->load->controller('Blog/Common/Layout');
                });

                // share|load settings for each request
                $app->share('settings', function ($app) {
                    $settingsModel = $app->load->model('Settings');

                    $settingsModel->loadAll();

                    return $settingsModel;
                });

         	    return $next;
         }
}