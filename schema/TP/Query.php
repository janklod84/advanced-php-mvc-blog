<?php 

function debug($arr)
{
	 echo '<pre>';
	 print_r($arr);
	 echo '</pre>';
}

function query()
{
	 $bindings = func_get_args();
	 $sql = array_shift($bindings); // echo $sql;
	 
	 if (count($bindings) == 1 AND is_array($bindings[0]))
	 {
	 	  $bindings = $bindings[0];
	 }

	 debug($bindings);
}

query('SELECT * FROM users WHERE id > ? AND id < ?', [1, 300]);