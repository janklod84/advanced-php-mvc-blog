<?php 
namespace System;


use Closure;
use Whoops\Run AS Whoops;
use Whoops\Util\Misc AS WhoopsMisc;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;


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
       * Application Object
       * 
       * @var \Sytem\Application
      */
      private static $instance;


  	  /**
  	   * Application constructor
  	   * 
  	   * @param \System\File $file
  	   */
  	  private function __construct(File $file)
  	  {     

             # Error Handler Whoops
             $this->handleErrors();


  	  	     # Share file in container
             $this->share('file', $file);


             # Load Helpers
             $this->loadHelpers();

  	  }


      /**
       * Handle Errors
       * 
      */
      private function handleErrors()
      {
            $run = new Whoops();
            $run->pushHandler(new PrettyPageHandler);
            
            if(WhoopsMisc::isAjaxRequest())
            {
                  $jsonHandler = new JsonResponseHandler();
                  $jsonHandler->addTraceToOutput(true);

                  $run->pushHandler($jsonHandler);
            }

            $run->register();
      } 


	    /**
        * Get Application Instance
        *
        * @param \System\File $file
        * @return \System\Application
      */
      public static function getInstance($file = null)
      {
          if(is_null(static::$instance))
          {
              static::$instance = new static($file);
          }
          return static::$instance;
      }
        


	    /**
       * Run the Application
       *
       * $route = $this->route->getProperRoute(); 
       * pre($route);
       * 
       * @return void
       */
       public function run()
       {
             // pre($_SERVER);
             
             # Start session
         	   $this->session->start();

         	   # Prepare URL
         	   $this->request->prepareUrl();

         	   # require file App/routes.php [or rename by App/index.php]
             $this->file->call('App/routes.php');

             # Get : Controller \ Method \ Arguments
             list($controller, $method, $arguments) = $this->route->getProperRoute();

             # Middleware
             if($this->route->hasCallsFirst())
             {
                  $this->route->callFirstCalls();
             }

             # Get content [ object convert to string ]
             $output =  (string) $this->load->action($controller, $method, $arguments);
        
             $this->response->setOutput($output);
             
             $this->response->send();
       }


  	  /**
  	   * Load Helpers File
  	   * 
  	   * 
  	   * @return void
  	  */
  	  public function loadHelpers()
  	  {
  	  	   $this->file->call('vendor/System/helpers.php');
  	  }


  	  /**
          * Get Shared Value
          *
          * @param string $key
          * @return mixed
        */
  	  public function get($key)
  	  { 
  	  	  # If key not in container
  	  	  if(! $this->isSharing($key))
  	  	  {
  	  	  	  # if key in core alias
  	  	  	  if($this->isCoreAlias($key) )
  	  	  	  {
  	  	  	  	   # we'll bind/share this key and create new core object
  	  	  	  	   $this->share($key, $this->createNewCoreObject($key));

  	  	  	  }else{ # if key isn't in core alias, we'll generate error msg
                      
                    die('<b>'. $key .'</b> not found in application container');
  	  	  	  }
  	  	  }

  	  	  # $this->isSharing($key) ? $this->container[$key] : null;
            return $this->container[$key];
  	  }


  	  /**
  	   * Determine if the given key is shared through Application
  	   * isSharing($key) ==> has($key)
  	   *
  	   * @param string $key
  	   * @return bool
  	  */
  	  public function isSharing($key): bool
  	  {
             return isset($this->container[$key]);
  	  }
        

  	  /**
  	   * Share the given key|value Through Application
  	   *  bind($key, $value)
  	   * 
  	   * @param string $key
  	   * @param mixed $value
  	   * @return mixed
  	   */
  	  public function share($key, $value)
  	  {
           if($value instanceof Closure)
           {
                $value = call_user_func($value, $this);
           }

  	  	   $this->container[$key] = $value;
  	  }


	   /**
       * Determine if the given key is an alias to core class [ coreClasses() ]
       *
       * @param string $alias
       * @return bool
       */
       private function isCoreAlias($alias)
       {
            $coreClasses = $this->coreClasses();
            return  isset($coreClasses[$alias]);
       }


       /** 
       * Create new object for the core class based on the given alias
       *
       * @param string $alias
       * @return object
       */
       private function createNewCoreObject($alias)
       {
            $coreClasses = $this->coreClasses();
            $object = $coreClasses[$alias];
            return new $object($this);
       }


	   /**
       * Get All Core Classes with its aliases
       *
       * $this->request  = new System\Http\Request()
       * $this->response = new System\Http\Response()
       * ....
       * ....
       * $this->app = new Application(File $file)
       * $this->app->request  = new System\Http\Request()
       * $this->app->response = new System\Http\Response()
       * 
       * @return array
       */

       private function coreClasses()
       {
       	   return [
                'request'    =>  'System\\Http\\Request',
                'response'    => 'System\\Http\\Response',
                'session'    =>  'System\\Session',
                'route'      =>  'System\\Route',
                'cookie'     =>  'System\\Cookie',
                'load'       =>  'System\\Loader',
                'html'       =>  'System\\Html',
                'db'         =>  'System\\Database',
                'view'       =>  'System\\View\\ViewFactory',
                'url'        =>  'System\\Url',
                'validator'  =>  'System\\Validation',
                'pagination'    => 'System\\Pagination'
       	   ];
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