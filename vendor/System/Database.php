<?php  
namespace System;

use PDO;
use PDOException;


/**
 * @package \System\Database
 * included QueryBuilder
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
        * Table Name
        *
        * @var string
        */
        private $table;


        /**
        * Data Container
        *
        * @var array
        */
        private $data = [];


        /**
        * Bindings Container
        *
        * @var array
        */
        private $bindings = [];


        /**
        * Last Insert Id
        *
        * @var int
        */
        private $lastId;


        /**
        * Wheres
        *
        * @var array
        */
        private $wheres = [];


      
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
        	//echo 'Connected';
            $connectionData = $this->app->file->call('config.php');
            extract($connectionData);

            try 
            {
            	  $dsn = sprintf(self::MSK_DSN, $server, $dbname);
                  static::$connection = new PDO($dsn , $dbuser, $dbpass);

                  static::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                  static::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  static::$connection->exec('SET NAMES utf8');

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
 

        /**
         * Set the table name
         *
         * @param string $table
         * @return $this
        */
        public function table($table)
        {
             $this->table = $table;
             return $this;
        }


        /**
        * Set the Data that will be stored in database table
        *
        * @param string $table
        * @return $this
        */
        public function from($table)
        {
             return $this->table($table);
        }


        /**
        * Set the Data that will be stored in database table
        *
        * @param mixed $key
        * @param mixed $value
        * @return $this
        */
        public function data($key , $value = null)
        {
             // 0 => 1
             // email => jy@g.com

             // 0 => 1
             // 1 => jy@g.com

             if(is_array($key))
             {
                 $this->data = array_merge($this->data, $key);
                 $this->addToBindings($key);

             }else{

                 $this->data[$key] = $value;
                 $this->addToBindings($value);
             }
             
             return $this;
        }


        /**
         * Insert Data to database
         *
         * @param string $table
         * @return $this
         */
         public function insert($table = null)
         {

             if($table)
             {
                $this->table($table);
             }

             $sql = 'INSERT INTO  '. $this->table .' SET ';
             $sql .= $this->setFields();

             $this->query($sql, $this->bindings);

             $this->lastId = $this->connection()->lastInsertId();
             
             // $this->reset();
             
             return $this;
         }


         /**
          * Add New Where clause
          *
          * @return
         */
         public function where()
         {
             $bindings = func_get_args();
             $sql = array_shift($bindings);
             $this->addToBindings($bindings);
             $this->wheres[] = $sql;

             return $this;
         }


         /**
          * Set the fields for insert and update
          *
          * @return string
         */
          private function setFields()
          {

               $sql = '';

               foreach (array_keys($this->data) as $key) 
               {
                   $sql .= '`' . $key . '` = ? , ';
               } 

               $sql = rtrim($sql, ', ');

               return $sql;
          }



         /**
         * Update Data In database
         *
         * @param string $table
         * @return $this
         */
         public function update($table = null)
         {

             if($table)
             {
                $this->table($table);
             }

             $sql = 'UPDATE  '. $this->table .' SET ';
             $sql .= $this->setFields();

             if($this->wheres)
             {
                 $sql .= ' WHERE ' . implode(' ' , $this->wheres);
             }


             $this->query($sql, $this->bindings);
              
             //$this->reset();

             return $this;
         }




         /**
          * Execute the given sql statement
          * 
          * $this->db->query('SELECT * FROM users WHERE id > ? AND id < ?', [1, 300]);
		  * $this->db->query('INSERT INTO users SET email = ? , SET status = ?', 'jeanyao@ymail.com', 'enabled');
          * $this->db->query('INSERT INTO users SET email = ? , SET status = ?', ['jeanyao@ymail.com', 'enabled']);
          * 
          * query(...$bindings)
          * @return \PDOStatement
          */
          public function query()
          {
          	   $bindings = func_get_args();
          	   $sql = array_shift($bindings);

          	   if(count($bindings) == 1 AND is_array($bindings[0]))
          	   {
          	   	   $bindings = $bindings[0];
          	   }

          	   try 
          	   {
          	   	    $query = $this->connection()->prepare($sql); // Type PDOStatement

	          	    foreach ($bindings as $key => $value)
	          	    {
	          	   	    $query->bindValue($key + 1, _e($value));
	          	    }

	          	    $query->execute();

	          	    return $query;

          	   }catch(PDOException $e){
                     
          	   	     echo $sql; // show Query
                     pre($this->bindings); // show Bindings params

                     die($e->getMessage());
          	   }
          }


         /**
          * Get the Last insert id
          *
          * @return int
         */
         public function lastId()
         {
             return $this->lastId;
         }


         /**
          * Add the given value to bindings
          * 
          * 0 => 1
          * 1 => 3
          * 2 => 2
          * 3 => 4
          * @param mixed $value
          * @return void
          */
          private function addToBindings($value)
          {
          	  if(is_array($value))
          	  {
                 $this->bindings = array_merge($this->bindings, array_values($value));

              }else{
               
                  $this->bindings[] =  $value;

              }
      
          }


}