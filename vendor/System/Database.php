<?php  
namespace System;

use PDO;
use PDOException;


/**
 * @package \System\Database
*/
class Database 
{
      
      const MSK_DSN = 'mysql:host=%s;dbname=%s';

	  /**
       * Application Object
       *
       * @var \System\Application
       */
       private $app;


       /**
       * PDO Connection
       *
       * @var \PDO
       */
       private static $connection;
      
       
       /**
        * Constructor
        *
        * System singleton [ If not connected , we'll connected ]
        * @param \System\Application $app
       */
       public function __construct(Application $app)
       {
       	    $this->app = $app;

       	    if( !$this->isConnected() )
       	    {
       	    	 $this->connect();
       	    }
       }


       /**
        * Determine if there is any connection to database
        *
        * return ! is_null(static::$connection)
        * 
        * @return bool
       */
       public function isConnected()
       {
           return static::$connection instanceof PDO;
       }


       /**
        * Connect to Database
        *
        * static::$connection = new PDO()
        * echo $this->isConnected() ==> 1 [connected] / 0 [not-connected]
        * 
        * @return void
        */
        private function connect()
        {
        	// echo 'Connected';
            $connectionData = $this->app->file->call('config.php');
            extract($connectionData);

            try 
            {
            	  $dsn = sprintf(self::MSK_DSN, $server, $dbname);
                  static::$connection = new PDO($dsn , $dbuser, $dbpass);

            }catch(PDOException $e){

            	 die($e->getMessage());
            }
        }


        /**
        * Get Database Connection Object PDO Object
        *
        * @return \PDO
        */
        public function connection()
        {
            return static::$connection;
        }

}