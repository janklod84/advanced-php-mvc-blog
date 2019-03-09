<?php  
/*
|---------------------------------------------
|          WHITE LIST ROUTES
|
|          add(uri, namespace)
|          Ex : $app->route->add('/admin/login', 'Admin\Login');
|          Ex : $app->route->add('/admin/login', 'Admin/LoginController');
|---------------------------------------------
*/

use System\Application;

$app = Application::getInstance();

/*
|---------------------------------------------
|          BLOG ROUTES http://localhost/blog/
|---------------------------------------------
*/
$app->route->add('/', 'Home');




////////////////////////////////////////////////////////////////////////////////////

/*
|---------------------------------------------
|          ADMIN LOGIN ROUTES http://localhost/blog/admin/login
|---------------------------------------------
*/

$app->route->add('/admin/login', 'Admin/Login');
$app->route->add('/admin/login/submit', 'Admin/Login@submit', 'POST');


/*
|---------------------------------------------
|          ADMIN DASHBOARD ROUTES
|---------------------------------------------
*/

$app->route->add('/admin' , 'Admin/Dashboard');
$app->route->add('/admin/dashboard' , 'Admin/Dashboard');

/*
|---------------------------------------------
|          ADMIN USERS ROUTES
|---------------------------------------------
*/

$app->route->add('/admin/users' , 'Admin/Users');
$app->route->add('/admin/users/add' , 'Admin/Users@add');
$app->route->add('/admin/users/submit' , 'Admin/Users@submit', 'POST');
$app->route->add('/admin/users/edit/:id', 'Admin/Users@edit');
$app->route->add('/admin/users/save/:id', 'Admin/Users@save', 'POST');
$app->route->add('/admin/users/delete/:id', 'Admin/Users@delete');



/*
|---------------------------------------------
|          ADMIN USERS-GROUPS ROUTES
|---------------------------------------------
*/
$app->route->add('/admin/users-groups', 'Admin/UsersGroups');
$app->route->add('/admin/users-groups/add', 'Admin/UsersGroups@add');
$app->route->add('/admin/users-groups/submit', 'Admin/UsersGroups@submit', 'POST');
$app->route->add('/admin/users-groups/edit/:id', 'Admin/UsersGroups@edit');
$app->route->add('/admin/users-groups/save/:id', 'Admin/UsersGroups@save', 'POST');
$app->route->add('/admin/users-groups/delete/:id', 'Admin/UsersGroups@delete');


/*
|---------------------------------------------
|          ADMIN POSTS ROUTES
|---------------------------------------------
*/

$app->route->add('/admin/posts', 'Admin/Posts');
$app->route->add('/admin/posts/add', 'Admin/Posts@add');
$app->route->add('/admin/posts/submit', 'Admin/Posts@submit', 'POST');
$app->route->add('/admin/posts/edit/:id', 'Admin/Posts@edit');
$app->route->add('/admin/posts/save/:id', 'Admin/Posts@save', 'POST');
$app->route->add('/admin/posts/delete/:id', 'Admin/Posts@delete');


/*
|---------------------------------------------
|          ADMIN COMMENTS ROUTES
|---------------------------------------------
*/

$app->route->add('/admin/posts/:id/comments', 'Admin/Comments');
$app->route->add('/admin/comments/edit/:id', 'Admin/Comments@edit');
$app->route->add('/admin/comments/save/:id', 'Admin/Comments@save', 'POST');
$app->route->add('/admin/comments/delete/:id', 'Admin/Comments@delete');


/*
|---------------------------------------------
|          ADMIN CATEGORIES ROUTES
|---------------------------------------------
*/

$app->route->add('/admin/categories', 'Admin/Categories');
$app->route->add('/admin/categories/add', 'Admin/Categories@add');
$app->route->add('/admin/categories/submit', 'Admin/Categories@submit', 'POST');
$app->route->add('/admin/categories/edit/:id', 'Admin/Categories@edit');
$app->route->add('/admin/categories/save/:id', 'Admin/Categories@save', 'POST');
$app->route->add('/admin/categories/delete/:id', 'Admin/Categories@delete');


/*
|---------------------------------------------
|          ADMIN SETTINGS ROUTES
|---------------------------------------------
*/

$app->route->add('/admin/settings', 'Admin/Settings');
$app->route->add('/admin/settings/save', 'Admin/Settings@save', 'POST');


/*
|---------------------------------------------
|          ADMIN CONTACTS ROUTES
|---------------------------------------------
*/

$app->route->add('/admin/contacts', 'Admin/Contacts');
$app->route->add('/admin/contacts/reply/:id', 'Admin/Contacts@reply');
$app->route->add('/admin/contacts/send/:id', 'Admin/Contacts@send', 'POST');



/*
|---------------------------------------------
|          ADMIN ADS ROUTES
|---------------------------------------------
*/

$app->route->add('/admin/ads', 'Admin/Ads');
$app->route->add('/admin/ads/add', 'Admin/Ads@add');
$app->route->add('/admin/ads/submit', 'Admin/Ads@submit', 'POST');
$app->route->add('/admin/ads/edit/:id', 'Admin/Ads@edit');
$app->route->add('/admin/ads/save/:id', 'Admin/Ads@save', 'POST');
$app->route->add('/admin/ads/delete/:id', 'Admin/Ads@delete');


/*
|---------------------------------------------
|          LOGOUT ROUTE
|---------------------------------------------
*/

$app->route->add('/logout' , 'Logout');


/*
|---------------------------------------------
|          NOT FOUND ROUTES / PAGES
|---------------------------------------------
*/
$app->route->add('/404', 'Error/NotFound');
$app->route->notFound('/404');