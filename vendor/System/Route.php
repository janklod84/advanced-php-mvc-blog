<?php
namespace System;


/**
 * @package \System\Route
*/
class Route
{

     
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
       * Not Found Url
       *
       * @var string
      */
      private $notFound;


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
        * Add New Route
        *
        * Optimise method 
        * Create new class RouteParam($url, $action, $requestMethod = 'GET') 
        * this class will be return $route or generate route with parameters lke this:
        * $route = [
             'url'      => $url,
             'pattern'  => $this->generatePattern($url),
             'action'   => $this->getAction($action), // target
             'method'   => strtoupper($requestMethod),
        * ];
        * @param string $url
        * @param string $action
        * @param string $requestMethod
        * @param void
      */
      public function add($url, $action , $requestMethod = 'GET')
      {
           $route = [
             'url'      => $url,
             'pattern'  => $this->generatePattern($url),
             'action'   => $this->getAction($action), // target
             'method'   => strtoupper($requestMethod),
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
       * Get Proper Route
       *
       * @return array
       */
       public function getProperRoute()
       {
            foreach ($this->routes as $route)
            {
                 // pre($route);
                 if($this->isMatching($route['pattern']) AND $this->isMatchingMethod($route['method']))
                 {
                      // pre($route['pattern']);
                      $arguments = $this->getArgumentsFrom($route['pattern']);
                      // pre($arguments);

                      // controller@method
                      list($controller, $method) = explode('@', $route['action']);

                      return [$controller, $method, $arguments];
                 }
            }

            // redirect to not found page ( si page introuvable)
            return $this->app->url->redirectTo($this->notFound); // 404
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