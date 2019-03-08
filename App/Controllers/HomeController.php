<?php 
namespace App\Controllers;

use System\Controller;


class HomeController extends Controller
{

  	 public function index()
  	 {
          pre($this->db->where('id != ?', 2)->fetchAll('users'));
          echo $this->db->rows();
          pre($this->db->fetchAll('users'));
  	 }
}
