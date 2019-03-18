<?php 
namespace App\Middleware\Admin;

use System\Application;
use App\Middleware\MiddlewareInterface;


class Auth implements MiddlewareInterface
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
         	   // return 'ok';

         	   if(strpos($app->request->url(), '/admin') === 0)
               {
			       
			             $loginModel = $app->load->model('Login');

			             $ignoredPages = ['/admin/login', '/admin/login/submit']; 
			             
			             $currentRoute = $app->route->getCurrentRouteUrl(); 
             
			             /*
			              First Scenario
			              User is not Logged in and he is not requesting Login page
			              then we will redirect him to login page
			             */
			             if(($isNotLogged = ! $loginModel->isLogged()) AND ! in_array($currentRoute , $ignoredPages)){

			                return $app->url->redirectTo('/admin/login');

			             }
             
			             /*
			               On going to this line
			               it means that are two possibilities
			               First One the user is not Logged in and he is requesting login page
			               Second One the user Logged in successfully and he is requesting
			               an admin page
			             */
			             if($isNotLogged)
			             {
			                  return false;
			             }
			             
			             $user = $loginModel->user();  // pred($user);
			             $usersGroupsModel = $app->load->model('UsersGroups');
			             $usersGroup = $usersGroupsModel->get($user->users_group_id);
             
			             /*
			             If the user doesn't have permissions to access this page
			             then he will be redirected to 404 page
			             */
			             if(! in_array($currentRoute, $usersGroup->pages))
			             {
			                  // we may create access-denied or 404 page 
			                  return $app->url->redirectTo('/404');
			                  // return $this->url->redirectTo('/404');
			             }
                }

         	    return $next;
         }
}