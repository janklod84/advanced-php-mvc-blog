<?php 
namespace App\Controllers;

use System\Controller;


class HomeController extends Controller
{

  	 public function index()
  	 {
           $this->response->setHeader('name', 'Brown');
           $data['my_name'] = 'Brown'; 
           return $this->view->render('home', $data);
  	 }
}


 /*
  echo 'Home::index';
  grace a la methode magique __get($key) ==> $this->app->get($key)
  echo $this->request->url();
  $this->session->set('name', 'Jean');
  echo $this->session->get('name');
  echo __METHOD__; 
  $this->load->controller('Header')->index();
           
  $this->load->controller('Common/Header')->index();
 */