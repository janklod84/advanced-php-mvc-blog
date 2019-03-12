<?php 
namespace App\Controllers\Admin;


use  System\Controller;


class  AccessController extends Controller
{
      
      /**
       * Check User Permissions to access admin pages
       *
       * @return void
       */
       public function index()
       {
             
             $loginModel = $this->load->model('Login');

             $ignoredPages = ['/admin/login', '/admin/login/submit']; 
             
             $currentPage = $this->request->url();

             if(!$loginModel->isLogged() AND ! in_array($currentPage, $ignoredPages))
             {
                  return $this->url->redirectTo('/admin/login');
             }
             
             $user = $loginModel->user();  // pred($user);
             $usersGroupsModel = $this->load->model('UsersGroups');
             $usersGroup = $usersGroupsModel->get($user->users_group_id);

             // pred($usersGroup);

             if(! in_array($currentPage, $usersGroup->pages))
             {
                  // we may create access-denied or 404 page 
                  // return $this->url->redirectTo('/404');
             }
     }

}

