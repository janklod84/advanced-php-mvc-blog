<?php 
namespace System\Http;


/**
 * GET, POST, REQUEST, FILE, SERVER
 * @package \System\Http\Request
 * 
 * get,post,request,isPost, isGet, isHttps, isAjax
*/
class Request
{

        /**
          * Url
          *
          * @var string
        */
        private $url;


        /**
          * Base Url
          *
          * @var string
        */
        private $baseUrl;

      
        /**
          * Prepare url
          *
          * $script : dirname('/index.php')  give in my book '\'
          * $requestUri : site.com/posts/edit?id=1
          * Keywords : SCRIPT_NAME, REQUEST_URI, QUERY_STRING
          * 
          * if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') { //HTTPS }
          * $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
          * $protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
          * @return void
          *
        */
        public function prepareUrl()
        {
             $script = dirname($this->server('SCRIPT_NAME')); 
             $requestUri = $this->server('REQUEST_URI'); 
             
             # pre(explode('?' , $requestUri));
             
             # si (?) est definit comme suit /blog/path/uri?id=3
             if(strpos($requestUri, '?') !== false)
             {
                 list($requestUri , $queryString) = explode('?' , $requestUri);
             }

             # echo $requestUri;
             # preg_replace('#^' . $script .'#', '', $requestUri); no work!!!
             # preg_replace('#^' . $script .'/#', '', $requestUri); work!!!

             $this->url = preg_replace('/^' . $script .'//', '', $requestUri);

             # pre($_SERVER);
             # $this->baseUrl = $this->server('REQUEST_SCHEME') . '://' . $this->server('HTTP_HOST') . $script;
            
             $protocol =  $this->protocol();
             echo $this->baseUrl = $protocol . $this->server('HTTP_HOST') . '/';
        }


        public function isHttps()
        {
           // $protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
           return isset($_SERVER["HTTPS"]);
        }


        public function protocol()
        {
           return $this->isHttps() ? 'https://' : 'http://';
        }


        /**
         * Get Value from __GET by the given key
         *
         * @param string $key
         * @param mixed $default
         * @return mixed
       */
       public function get($key, $default = null)
       {
            return array_get($_GET, $key , $default);     
       }
     

       /**
       * Get Value from __POST by the given key
       *
       * @param string $key
       * @param mixed $default
       * @return mixed
       */
       public function post($key, $default = null)
       {
            return array_get($_POST, $key , $default);
       }
     
      
       /**
       * Get Value from __SERVER by the given key
       *
       * @param string $key
       * @param mixed $default
       * @return mixed
       */
       public function server($key, $default = null)
       {
            return array_get($_SERVER, $key , $default);
       }


       /**
        * GET Request Method
        * 
        * @return string
        */
        public function method()
        {
             return $this->server('REQUEST_METHOD');
        }

        /**
         * Get the Referer link
         *
         * @return string
         */
        public function referer()
        {
           return $this->server('HTTP_REFERER');
        }



        /**
         * Get full url of the script
         * 
         * @return string
        */
        public function baseUrl()
        {
            return $this->baseUrl;
        }

       /**
         * Get Only relative url (clean url)
         *
         * @return string
         *
       */
       public function url()
       {
            return  $this->url;
       }
     
}
