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
        * Selects
        *
        * @var array
        */
        private $selects = [];

        /**
        * Limit
        *
        * @var int
        */
        private $limit;

        /**
        * Offset
        *
        * @var int
        */
        private $offset;

        /**
        * Total Rows
        *
        * @var int
        */
        private $rows = 0;

        /**
        * Joins
        *
        * @var array
        */
        private $joins = [];
  
        /**
        * Order By
        *
        * @param array
        */
        private $orderBy = [];

     
      
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
        * Set select clause
        *
        * @param string $select
        * @return  $this
        */
        public function select(...$selects)
        {
        	  // for those who use PHP 5.6 , you can use the ... operator
          
            // otherwise , use the following line to get all passes arguments
            $selects = func_get_args();

            $this->selects = array_merge($this->selects, $selects);

            return $this;
        }


        /**
        * Set join clause
        *
        *
        * @param string $join [LEFT, INNER, RIGHT]
        * @return  $this
        */
        public function join($join)
        {
            $this->joins[] = $join;
            return $this;
        }



       /**
        * Set  Order By clause
        *
        *
        * @param string $column
        * @param string $sort
        * @return  $this
        */
        public function orderBy($orderBy , $sort = 'ASC')
        {
            $this->orderBy = [$orderBy , $sort];     
            return $this;
        }


        /**
        * Set Limit and offset
        *
        * @param int $limit
        * @param int $offset
        * @return  $this
        */
        public function limit($limit, $offset = 0)
        {
            $this->limit = $limit;
            $this->offset = $offset;
            return $this;
        }


        /**
         * Fetch Table
         * This will return only one record
         *
         * @param string $table
         * @return \stdClass | null
         */
         public function fetch($table = null)
		     {

              if($table)
              {
                 $this->table($table);
              }
             
              $sql = $this->fetchStatement();
              $result = $this->query($sql , $this->bindings)->fetch();
              $this->reset();

              return $result;
         }

        /**
         * Fetch All Records from Table
         *
         * @param string $table
         * @return  array
         */
         public function fetchAll($table = null)
         {
              if($table)
              {
                 $this->table($table);
              }
             
              $sql = $this->fetchStatement();
              $query = $this->query($sql, $this->bindings);
              $results = $query->fetchAll();
              $this->rows = $query->rowCount();
              $this->reset();

              return $results;
         }

         /**
          * Get total rows from last fetch all statement
          *
          * @return int
         */
          public function rows()
          {
               return $this->rows;
          }


         /**
          * Prepare Select Statement
          * 
          * @return string
          */
          private function fetchStatement()
          {
               $sql = 'SELECT ';

               if($this->selects)
               {
               	    $sql .= implode(',', $this->selects);

               }else{

               	    $sql .= '*';
               }
               
               $sql .= ' FROM ' . $this->table .' ';

               if($this->joins) 
               {
               	   $sql .= implode(' ', $this->joins);
               }

               if($this->wheres)
               {
                   $sql .=  ' WHERE ' . implode(' ' , $this->wheres) . ' ';
               }

               if($this->limit)
               {
                  $sql .= ' LIMIT ' . $this->limit;
               }

               if($this->offset)
               {
                  $sql .= ' OFFSET ' . $this->offset;
               }

               if($this->orderBy)
               {
                  $sql .= ' ORDER BY ' . implode(' ' , $this->orderBy);
               }

               return $sql;
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
         * Delete Clause
         *
         * @param string $table
         * @return $this
         */
         public function  delete($table = null)
         {

             if($table)
             {
                $this->table($table);
             }

             $sql = 'DELETE  FROM '. $this->table .' ';

             if($this->wheres)
             {
                 $sql .= ' WHERE ' . implode(' ' , $this->wheres);
             }

             $this->query($sql, $this->bindings);
             $this->reset();

             return $this;
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
             
             $this->reset();
             
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
              
             $this->reset();

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


          /**
          * Reset All Data
          *
          * @return void
          */
          private function reset()
          {
             $this->limit = null;
             $this->table = null;
             $this->offset = null;
             $this->data = [];
             $this->joins = [];
             $this->wheres = [];
             $this->orderBy = [];
             $this->selects = [];
             $this->bindings = [];
          }

}