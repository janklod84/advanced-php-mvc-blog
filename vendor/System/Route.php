<?php
namespace System;


use Exception;


/**
 * @package \System\Route
*/
class Route
{

       
       /**
        * Next Flag
        * 
        * @const string
        */
        const NEXT = '__NEXT__';
 

       /**
        * Application Object
        *
        * @var \System\Application
      */
      private $app;


      /**
        * Routes Container
        *
        * @var array
      */
      private $routes = [];


      /**
       * Current Route
       *
       *
       * @var array
      */
      private $current = [];


      /**
       * Not Found Url
       *
       * @var string
      */
      private $notFound;

      
      /**
       * Prefix url
       * 
       * @var string
      */
      private $prefix;


      /**
       * Group Middleware
       * 
       * @var array
      */
      private $groupMiddleware = [];


      /**
       * Group Base Controller
       * 
       * @var string
      */
      private $baseController;



      /**
      * Constructor
      *
      * @param \System\Application $app
      */
      public function __construct(Application $app)
      {
           $this->app = $app;
      }

      /**
       * Add routes to group
       * 
       * @param array $groupOptions
       * @param callable $callback
       * @return $this
      */ 
      public function group(array $groupOptions, callable $callback)
      {
           $prefix = array_get($groupOptions, 'prefix');
           $controller = array_get($groupOptions, 'controller');
           $middleware = (array) array_get($groupOptions, 'middleware');
           
           // some rules
           // 1- group will not be executed `callback` unless, the current url must match the prefix
           // 2- Any group except the frontend one '/' must be written before the frontend group
           // 3 - one prefix can have many groups
           // i.e index.php routes => will contain admin routes + frontend routes
           // cms.php routes => will contain admin routes that are related to cms only + frontend routes for that cms.
           

           // If there is a previous prefix value
           // it means there was a group called before the current group call
           // this, if the prefix of the current group doesn't match the global prefix
           // then skip this group and don't execute it


           // Let's say
           // first group was for the admin script '/admin'
           // $this->prefix = /admin
           // second group for frontend script '/'
           // $prefix => frontend  `/` == $this->prefix `/admin` ?
           if(($this->prefix AND $prefix != $this->prefix) 
              OR ($prefix AND strpos($this->app->request->url(), $prefix) !== 0))
           {
                return $this;
           }

           
           // current url => http://localhost/blog/
           // current group => /admin

           if($prefix)
           {
              $this->prefix = $prefix;
           }

           $this->baseController = $controller;
           
           $this->groupMiddleware = $middleware;

           call_user_func($callback, $this);  # $callback($this);

           return $this;
      }


      /**
       * Add new package of routes for CRUD
       * 
       * @param string $url
       * @param string $controller
       * @return $this
      */
      public function package($url, $controller)
      {
           $this->add("$url", "$controller");
           $this->add("$url/add", "$controller@add" , 'POST');
           $this->add("$url/submit", "$controller@submit", 'POST');
           $this->add("$url/edit/:id", "$controller@edit", 'POST');
           $this->add("$url/save/:id", "$controller@save", 'POST');
           $this->add("$url/delete/:id", "$controller@delete" , 'POST');

           return $this;
      }



      /**
       * Get all routes
       * 
       * @return array
      */
      public function routes()
      {
          return $this->routes;
      }



      /**
        * Add New Route
        *
        * @param string $url
        * @param string $action
        * @param string $requestMethod
        * @param array $middleware
        * @param void
      */
      public function add($url, $action , $requestMethod = 'GET', array $middleware = [])
      {
           if($this->prefix)
           {
               // assuming prefix = '/'
               // url = /
               // $url = //
               // so we need to remove the last trailing slash
               $url =  rtrim($this->prefix . $url, '/');

               if(! $url) { $url = '/'; }

           }

           if($this->baseController)
           {
                 $action = $this->baseController . '/' . $action;
           }

           if($this->groupMiddleware)
           {
               $middleware = array_merge($this->groupMiddleware, $middleware);
           }

           $route = [
               'url'      => $url,
               'pattern'  => $this->generatePattern($url),
               'action'   => $this->getAction($action), // target
               'method'   => strtoupper($requestMethod),
               'middleware' => $middleware
           ];
           
           $this->routes[] = $route;
      }


      

      /**
        * Set Not Found Url
        *
        * @param string $url
        * @return void
      */
      public function notFound($url)
      {
           $this->notFound = $url;
      }


      
      /**
       * Get Proper Route and send the output to the application class
       *
       * @return string
       */
       public function getProperRoute()
       {
            $middlewareInterface = 'App\\Middleware\\MiddlewareInterface';
            
            /* pred($this->routes); */

            foreach ($this->routes as $route)
            {
                 if($this->isMatching($route['pattern']) AND $this->isMatchingMethod($route['method']))
                 {
                      $this->current = $route;
                      
                      // route found
                      // we need to see if the current route has any middlewares
                      
                      $output = '';

                      if ($route['middleware'])
                      {
                           // now we will loop though the middleware
                           foreach ($route['middleware'] as $middleware)
                           {
                                // we need to check first if the middleware class
                                // implements the middleware interface
                                // $middleware value = Admin\Auth
                                // full middleware class = App\Middleware\Admin\Auth
                                
                                $middlewareClass = 'App\\Middleware\\' . $middleware;
                                // class_implements ? returns array of all interfaces that class implements
                                
                                if(! in_array($middlewareInterface, class_implements($middlewareClass)))
                                {
                                     throw new Exception(sprintf('%s must implement %s', $middleware, $middlewareInterface));
                                     
                                }

                                $middleWareObject = new $middlewareClass;

                                // we need to get the output of the handle method to check
                                $output = $middleWareObject->handle($this->app, static::NEXT);

                                if($output)
                                {
                                    if($output === static::NEXT)
                                    {

                                          $output = '';

                                    }else{
                                         
                                         // it means the middleware 
                                         // has returned another value 
                                         // than the next flag
                                         // so this value will be returned for the response output 
                                         break;
                                    }
                                }
                           }
                      }

                      // if there is an output value,
                      // then we are not going to execute the route controller
                      // otherwise, we are going to execute our route controller
                      if($output == '')
                      {
                          $arguments = $this->getArgumentsFrom($route['pattern']);

                          // controller@method
                          list($controller, $method) = explode('@', $route['action']);
                          
                          $output =  (string) $this->app->load->action($controller, $method, $arguments);
                      }

                      return $output;
                 }
            }

            // redirect to not found page ( si page introuvable)
            return $this->app->url->redirectTo($this->notFound); // 404
       }


       /**
        * Get Current Route Url
        *
        * @return string
       */
        public function getCurrentRouteUrl()
        {
            return $this->current['url'];
        }

       
       /**
         * Determine if the given pattern matches the current request url
         *
         * @param string $pattern
         * @return bool
       */
        private function isMatching($pattern)
        {
            return preg_match($pattern , $this->app->request->url());
        }


       /**
         * Determine if the current request method equals
         * the given route method
         *
         * @param string $routeMethod
         * @return bool
       */
        private function isMatchingMethod($routeMethod)
        {
            return $routeMethod == $this->app->request->method();
        }


        /**
         * Get Arguments from the current request url
         * based on the given pattern
         *
         * @param string $pattern
         * @return array
       */
        public function getArgumentsFrom($pattern)
        {
              preg_match($pattern , $this->app->request->url() , $matches);
              
              array_shift($matches);

              return $matches;
        }


        /**
           * Generate a regex pattern for the given url
           *
           * @param string $url
           * @return string
        */
        private function generatePattern($url)
        {
             $pattern = '#^';
             $pattern .= str_replace([':text', ':id'], ['([a-zA-Z0-9-]+)' , '(\d+)'] , $url);
             $pattern .='$#';

             return $pattern; // #^/$#
        }

        /**
          * Get The Proper Action
          *
          * Posts\home remplace by Posts/home
          * By default action = index
          * @param string $action
          * @return string
        */
        private function getAction($action)
        {
             $action = str_replace('/', '\\', $action);
             return strpos($action , '@') !== false ? $action : $action .'@index';

        }


}