<?php 
namespace App\Controllers\Admin;

use System\Controller;


class LoginController extends Controller
{
	     
	     /**
	       * Display Login form
	       *
	       * [ex: code = sha1(mt_rand(1, 10000) . time()) ]
	       * @return mixed
	     */
	  	 public function index()
	  	 {

	  	 	   $loginModel = $this->load->model('Login'); 
               
	           if($loginModel->isLogged()) 
	           { 
           	       return $this->url->redirectTo('/admin');
	           }

	  	 	   $data['errors'] = $this->errors;

	           return $this->view->render('admin/users/login', $data);
	  	 }


	  	 /**
	       * Submit Login form
	       *
	       * @return mixed
	     */
	     public function submit()
	     {
	     	   // echo $a; tester Whoops ErrorHandler

	     	   $json = [];

	           if($this->isValid())
	           {
	           	    $loginModel = $this->load->model('Login');
          	        $loggedInUser = $loginModel->user();

                    if ($this->request->post('remember'))
                    {
                         // save login data in cookie
                    	 $this->cookie->set('login', $loggedInUser->code);

                    } else {

                         // save login data in session
                         $this->session->set('login', $loggedInUser->code);
                    }

	                $json['success']  = 'Welcome Back <b>' . $loggedInUser->first_name . '</b>';
	                $json['redirect'] = $this->url->link('/admin');

	           }else{

	          	    $json['errors'] = implode('<br>', $this->errors);
	           }

	           return $this->json($json); // Method from Controller class
	     }


	   /**
	     * Validate a Login Form
	     * 
	     *
	     * @return bool
	    */
	    private function isValid()
	    {
		         $email = $this->request->post('email');
		         $password = $this->request->post('password');
		         
		         # Validation Email
		         if(! $email )
		         {
		         	  $this->errors[] = 'Please Insert Email address';

		         } elseif(! filter_var($email, FILTER_VALIDATE_EMAIL)) {

			   	  	  $this->errors[] = 'Please Insert Valid Email';
			   	 }

			   	 # Validation Password
			   	 if(! $password)
			   	 {
		   	  	      $this->errors[] = 'Please Insert Password';
		   	     }

		   	     # Validation
		   	     if(! $this->errors)
		   	     {
		   	     	  $loginModel = $this->load->model('Login');

			   	      if(! $loginModel->isValidLogin($email, $password))
			   	      {
	                      $this->errors[] = 'Invalid Login Data';
			   	      }

		   	     }

		   	     /** return count($this->errors) > 0 ? false : true; **/

		   	     return empty($this->errors);

	    }
          
}
