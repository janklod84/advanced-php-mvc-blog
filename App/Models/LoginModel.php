<?php 
namespace App\Models;

use System\Model;


class  LoginModel extends Model
{
	

        /** 
         * Table name
         *
         *
         * @var string
        */

         protected $table = 'users';

       
         /**
          * Logged In User
          *
          * @var \stdClass
         */
         private $user;



         /**
          * Determine if the given Login data is valid
          *
          * Grace a la methode magic dans Model,
          * $this->where() revient a $this->db->where()
          * 
          * @param string $email
          * @param string $password
          * @return bool 
          */
         public function isValidLogin($email, $password)
         {
             
         	  $user = $this->where('email=?' , $email)->fetch($this->table);

         	  if(! $user) { return false; }

            $this->user = $user;

         	  return password_verify($password, $user->password);

         }

         /**
          * Get Logged In User data
          *
          * @return \stdClass
          */
         public function user()
         {
         	   return $this->user;
         }
         

         /**
          * Determine whether the user is logged in
          *
          * @return bool
          *
        */
         public function isLogged()
         {

               if($this->cookie->has('login')){

                    $code = $this->cookie->get('login');
                    // $code = ''; // just for now

               }elseif($this->session->has('login')){

                   $code = $this->session->get('login'); 
                  
               }else{

                   $code = '';
               }

               $user = $this->where('code=?' , $code)->fetch($this->table);

               if(! $user) 
               { 
                  return false; 
               }

               $this->user = $user;

               return true;
         }



}

