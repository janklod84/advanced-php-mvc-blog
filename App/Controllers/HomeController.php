<?php 
namespace App\Controllers;

use System\Controller;


class HomeController extends Controller
{

  	 public function index()
  	 {
           // echo __METHOD__; 
  	 	     $this->load->controller('Header')->index();
  	 }
}


 /*
  echo 'Home::index';
  grace a la methode magique __get($key) ==> $this->app->get($key)
  echo $this->request->url();
  $this->session->set('name', 'Jean');
  echo $this->session->get('name');

  $this->load->controller('Common/Header')->index();
 */