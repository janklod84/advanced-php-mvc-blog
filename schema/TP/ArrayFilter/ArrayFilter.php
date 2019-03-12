<?php 


function debug($arr)
{
	 echo '<pre>';
     print_r($arr);
     echo '</pre>';
}


/** On filtre un tableau en choisissant ceux qui ne sont que des numerics **/

$array = ['name', 'test', 1, 2, 3];

$filteredArray = [];


foreach($array as $value)
{
	if(!is_numeric($value))
	{
		 continue;
	}

	$filteredArray[] = $value;
}


debug($filteredArray);

/*** Revient a ***/

debug(array_filter($array, 'is_numeric'));