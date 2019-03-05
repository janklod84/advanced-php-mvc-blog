<?php  
/*
|---------------------------------------------
|          WHITE LIST ROUTES
|---------------------------------------------
*/

use System\Application;

$app = Application::getInstance();

// pre($app);


/*
|---------------------------------------------
|           ROUTE  REPRESENTATION
|           Array
|			(
|		        [url] => /
|			    [pattern] => #^/$#
|			    [action] => Main\Home@index
|			    [method] => GET
|			)
|---------------------------------------------
*/

# we can write 'Main\Home' or 'Main/Home'
$app->route->add('/', 'Main/Home', 'POST');


# /blog/posts/my-title-post/65435453 
# #^/posts/([a-zA-Z0-9-]+)/(\d+)$#
$app->route->add('/posts/:text/:id', 'Posts/Post');



/*
|---------------------------------------------
|          NOT FOUND ROUTES / PAGES
|---------------------------------------------
*/
$app->route->add('/404', 'Error/NotFound');
$app->route->notFound('/404');