<?php  
namespace System;


/**
 * @package \System\Session
*/
class Session
{

	  /**
       * Application Object
       *
       * @var \System\Application
       */

       private $app;


       /**
        * Constructor
        *
        * @param \System\Application $app
       */
       public function __construct(Application $app){

             $this->app = $app;
       }


       /**
        * Set New Value to Session
        *
        * @param string $key
        * @param mixed $value
        * @return void
       */
       public function set($key , $value)
       {
       	   $_SESSION[$key] = $value;
       }

}