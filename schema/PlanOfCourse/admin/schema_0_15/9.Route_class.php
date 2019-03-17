<?php 

/**
* Route Class
*
*
* Prerequisites
* Good Knowledge OF Regular Expressions
* preg_match
*
* Class Proprieties
* private  \System\Application $app : Application Object
* private array $routes : ALL Routes Container
*
* /blog/users/add ou /BlogSystem/users/add
* /blog/users/submit
* /blog/blablablabla	
* /blog/404
*
* controller@method
* controller@index
*
* void Route::add($url , $action , $requestMethod = GET)  Add new Route
* void Route::generatePattern($url)  Generate regex pattern for the given url
* void Route::getAction($action)  Get action which contains controller followe
* void Route::notFound($url)  Set not found url that will be redirect i no match
* array Route::getProperRoute Get the controller, method and its passed arguments
* bool Route::isMatching($pattern) Determine if the given pattern matching the
* array Route::getArgumentsFor($pattern)  Get the arguments from the url based 
*
*
*/

// DON'T FORGET TO CHECK array_shift() also :D))
