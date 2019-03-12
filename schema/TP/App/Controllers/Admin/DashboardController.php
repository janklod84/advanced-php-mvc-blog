<?php 
namespace App\Controllers\Admin;

use  System\Controller;


class  DashboardController extends Controller
{
   
	   public function index()
     {
           return $this->view->render('admin/main/dashboard');
	   }

	   public function submit()
     {
         // pre($_SESSION);
         //$json['name'] = $this->request->post('fullname');
         //return $this->json($json);
          
          // $userId = 1;

	   	    $this->validator->required('email')
	   	                   ->email('email')
                         ->unique('email', ['users' , 'email']);
	   	                   // ->unique('email', ['users' , 'email', 'id', $userId]);

           $this->validator->required('password')
                           ->minLen('password', 8);

           $this->validator->match('password', 'confirm_password');
          
           //$file = $this->request->file('image'); // UploadedFile Object
           
           //if($file->isImage())
           //{
           	   //$file->moveTo($this->file->to('public/images'));
           	 
           //}
           
           pre($this->validator->getMessages());
	   	   
	   }

}

// echo $file->moveTo($this->file->to('public/images')); (nom fichier genere)
// echo $file->moveTo($this->file->to('public/images') , 'newImage'); (nom fichier ecrit manuellement)