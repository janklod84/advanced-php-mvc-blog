<?php 

/**
|- Database + Models
|-
|- Prerequisites
|- Exceptions
|- PDO
|- Chaining Methods
|-
|---------------------------------------
|- Config File
|- Will be an array that will contain database connection data
|- 
|-
|- server: Server name , usually "localhost"
|- dbname : Database Name
|- dbuser : Database User
|- dbpass : Database Password
|-
|-------------------------------
|- Database Class
|- 
|- This class is fully responsible for handling all queries on database
|-
|- Properties
|-
|- private \System\Apllication $app: Application Object
|- private static PDO $connection: PDO Object
|- private int $lastId Get the last insert id after insert query
|- private array $data The data that will be stored in database => Used will insert and update methods
|- private string $wheres A Container for where clause
|- private array $table The table name
|- private array $bindings Used for binding data

|- private int $rows Total number of rows returned from fetchAll query
|- private int $limit Limit the number of returned records
|- private int $offset Start Getting records from this offset => Zero is the first record
|- private array $joins A Container for join clause
|- private string $orders Order the records 
|- private array $selects Determine which column(s) will be selected
|-
|-
|-
|- Methods
|-
|- public \System\Database from(string $table)
|- public \System\Database table(string $table)
|- public \System\Database where(string $where , ..$values)
|- public \System\Database insert(string $table = null)
|- public \System\Database data(mixed $key, mixed $value)
|- public \System\Database update()
|- public \PDOStatement query(string $sql, array ..$bindings) : Execute 
|- public int lastId()
|- private  \PDO connection()
|- private  void connect()
|- private void addToBindings(mixed $bindings)

|- public \System\Database select(string $select)
|- public \System\Database limit(int $limit, int $offset = 0)
|- public \System\Database orderBy(string $orderBy)
|- public \System\Database delete()
|- public \stdClass   fetch(string $table = null)
|- public array    fetchAll(string $table = null)
|- public array getBindings()
|- private string fetchStatement()
|- private void reset()
|- 
--|


mixed ( signifit melange , n'importe quoi string, booleen , int etc..)
==========
INSERT
==========

INSERT INTO TABLE_NAME (username , email) VALUES('hasan' , email)  VALUES('John' , 'jeanyao@ymail.com');

INSERT INTO TABLE_NAME SET username='John' , email='jeanyao@ymail.com';

prepare statement
INSERT INTO TABLE_NAME SET username = ? , email = ?;

TABLE_NAME

DATA [ $key => $value]

================================================
SELECT COLUMNS(*) FROM TABLE LEFT JOIN TABLE_2 ON ... WHERE ...
LIMIT NUMBER OFFSET NUMBER ORDER BY COLUMN