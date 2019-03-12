<?php 
namespace App\Controllers\Admin;

use  System\Controller;


class  LogoutController extends Controller
{
      
      /**
       * Log the user out
       *
       * @return mixed
       */
	   public function index()
	   {

           $this->session->destroy();
           $this->cookie->destroy();
           
           return $this->url->redirectTo('/admin/login');
	   }



}
