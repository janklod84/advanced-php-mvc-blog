<?php 
namespace System;

/**
 * @package \System\Application 
*/ 
class Application 
{
      
      /**
       * Container
       * 
       * @var array
      */
	  private $container = [];


	  /**
	   * Application constructor
	   * 
	   * @param \System\File $file
	   */
	  public function __construct(File $file)
	  {
	  	   # Share file in container
           $this->share('file', $file);

           # Autoloading classes
           $this->registerClasses(); 

           # Load Helpers
           $this->loadHelpers();

           pre($this->file);

	  }


	  /**
	   * Register classes in spl_autoload_register
	   * 
	   * @return void
	   */
	  public function registerClasses()
	  {
           spl_autoload_register([$this, 'load']);
	  }


	  /**
	   * Load Class through autoloading
	   * 
	   * @param string $class
	   * @return void
	   */
	  public function load($class)
	  {
	  	   if (strpos($class, 'App') === 0)
	  	   {
	  	   	   $file = $this->file->to($class.'.php');

	  	   }else{
               
                # Get the class from vendor
                # Exemple : $this->file->toVendor('System\\Test.php')
                $file = $this->file->toVendor($class.'.php');    
	  	   }

	  	   # Require file if it's exist
	  	   if($this->file->exists($file))
   	       {
                $this->file->require($file);
   	       }
	  }

	  /**
	   * Load Helpers File
	   * 
	   * 
	   * @return void
	  */
	  public function loadHelpers()
	  {
	  	   $this->file->require($this->file->toVendor('helpers.php'));
	  }


	  /**
        * Get Shared Value
        *
        * @param string $key
        * @return mixed
      */
	  public function get($key)
	  {
          return isset($this->container[$key]) ? $this->container[$key] : null;
	  }
      

	  /**
	   * Share the given key|value Through Application
	   * 
	   * @param string $key
	   * @param mixed $value
	   * @return mixed
	   */
	  public function share($key, $value)
	  {
	  	   $this->container[$key] = $value;
	  }


	  /**
	   * Get shared value dynamically
	   * Represente for exemple 
	   * [$this->file = new \System\File(__DIR__)]
	   * [$this->request = ...]
	   * 
	   * If $key in container it'll return it's value
	   * $this = Application, file = key in container
	   * 
	   * @param string $key
	   * @return mixed
	  */
	  public function __get($key)
	  {
	  	  return $this->get($key);
	  }
	   

}