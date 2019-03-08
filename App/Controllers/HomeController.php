<?php 
namespace App\Controllers;

use System\Controller;


class HomeController extends Controller
{

  	 public function index()
  	 {
         $user = $this->load->model('Users');
         // pre($user->all());

         pre($user->get(1));
  	 }
}
