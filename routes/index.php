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

$app = app();


// Why we are going to use exceptions ?
// production => errors will be stored in error.log file
// errors should be only displayed in the development mode



# Middleware Access

/*
if (strpos($app->request->url(), '/admin') === 0)
{
        # check if the current url started with /admin
        # if so, then call our middlewares

	    // $app->load->action('Admin/Access', 'index');
    	 $app->route->callFirst(function($app){
          	 $app->load->action('Admin/Access', 'index'); 
    	 });
       
        // share admin layout
	    $app->share('adminLayout', function ($app) {
	        return $app->load->controller('Admin/Common/Layout');
	    });

} else {


		// share Blog layout
	    $app->share('blogLayout', function ($app) {
	        return $app->load->controller('Blog/Common/Layout');
	    });

	    // share|load settings for each request
	    $app->share('settings', function ($app) {
	        $settingsModel = $app->load->model('Settings');

	        $settingsModel->loadAll();

	        return $settingsModel;
	    });
}

*/

/*
|---------------------------------------------
|          ADMIN ROUTES http://localhost/blog/admin [ EXPECTED GROUP CODE ]
|---------------------------------------------
*/

$adminOptions = [
	 'prefix' => '/admin',
	 'controller' => 'Admin',
	 'middleware' => ['Admin\\Auth', 'Admin\\Config']
];

$app->route->group($adminOptions, function ($route) {
    
        // pred($route);
        /*
		|---------------------------------------------
		|          ADMIN DASHBOARD ROUTES
		|---------------------------------------------
		*/

		$route->add('/' , 'Dashboard');
		// $route->add('/submit' , 'Dashboard@submit', 'POST');


	    /*
		 |---------------------------------------------
		 |          ADMIN ROUTES
		 |---------------------------------------------
	   */
		$route->add('/login', 'Login');
		$route->add('/login/submit', 'Login@submit', 'POST');


		/*
		|---------------------------------------------
		|          ADMIN USERS ROUTES
		|---------------------------------------------
		*/

		$route->add('/users', 'Users');
		$route->add('/users/add', 'Users@add' , 'POST');
		$route->add('/users/submit', 'Users@submit', 'POST');
		$route->add('/users/edit/:id', 'Users@edit', 'POST');
		$route->add('/users/save/:id', 'Users@save', 'POST');
		$route->add('/users/delete/:id', 'Users@delete' , 'POST');


		/*
		|---------------------------------------------
		|          ADMIN USER PROFILE
		|---------------------------------------------
		*/


		$route->add('/profile/update', 'Profile@update', 'POST');




		/*
		|---------------------------------------------
		|          ADMIN USERS-GROUPS ROUTES
		|---------------------------------------------
		*/
		$route->add('/users-groups', 'UsersGroups');
		$route->add('/users-groups/add', 'UsersGroups@add', 'POST');
		$route->add('/users-groups/submit', 'UsersGroups@submit', 'POST');
		$route->add('/users-groups/edit/:id', 'UsersGroups@edit', 'POST');
		$route->add('/users-groups/save/:id', 'UsersGroups@save', 'POST');
		$route->add('/users-groups/delete/:id', 'UsersGroups@delete', 'POST');


		/*
		|---------------------------------------------
		|          ADMIN CATEGORIES ROUTES
		|          it's will be converted to /admin/categories
		|          Categories => Admin/Categories
		|---------------------------------------------
		*/

		$route->add('/categories', 'Categories');
		$route->add('/categories/add', 'Categories@add', 'POST');
		$route->add('/categories/submit', 'Categories@submit', 'POST');
		$route->add('/categories/edit/:id', 'Categories@edit', 'POST');
		$route->add('/categories/save/:id', 'Categories@save', 'POST');
		$route->add('/categories/delete/:id', 'Categories@delete', 'POST');



		/*
		|---------------------------------------------
		|          ADMIN POSTS ROUTES
		|---------------------------------------------
		*/

		$route->add('/posts', 'Posts');
		$route->add('/posts/add', 'Posts@add', 'POST');
		$route->add('/posts/submit', 'Posts@submit', 'POST');
		$route->add('/posts/edit/:id', 'Posts@edit', 'POST');
		$route->add('/posts/save/:id', 'Posts@save', 'POST');
		$route->add('/posts/delete/:id', 'Posts@delete', 'POST');


		/*
		|---------------------------------------------
		|          ADMIN COMMENTS ROUTES
		|---------------------------------------------
		*/

		$route->add('/posts/:id/comments', 'Comments');
		$route->add('/comments/edit/:id', 'Comments@edit');
		$route->add('/comments/save/:id', 'Comments@save', 'POST');
		$route->add('/comments/delete/:id', 'Comments@delete');



		/*
		|---------------------------------------------
		|          ADMIN SETTINGS ROUTES
		|---------------------------------------------
		*/

		$route->add('/settings', 'Settings');
		$route->add('/settings/save', 'Settings@save', 'POST');


		/*
		|---------------------------------------------
		|          ADMIN CONTACTS ROUTES
		|---------------------------------------------
		*/

		$route->add('/contacts', 'Contacts');
		$route->add('/contacts/reply/:id', 'Contacts@reply');
		$route->add('/contacts/send/:id', 'Contacts@send', 'POST');



		/*
		|---------------------------------------------
		|          ADMIN ADS ROUTES
		|---------------------------------------------
		*/

		$route->add('/ads', 'Ads');
		$route->add('/ads/add', 'Ads@add', 'POST');
		$route->add('/ads/submit', 'Ads@submit', 'POST');
		$route->add('/ads/edit/:id', 'Ads@edit', 'POST');
		$route->add('/ads/save/:id', 'Ads@save', 'POST');
		$route->add('/ads/delete/:id', 'Ads@delete', 'POST');


		/*
		|---------------------------------------------
		|          LOGOUT ROUTE
		|---------------------------------------------
		*/

		$route->add('/logout' , 'Logout');


}); // End Group routes





////////////////////////////////////////////////////////////////////////////////////

/*
|---------------------------------------------
|          BLOG ROUTES http://localhost/blog/
|---------------------------------------------
*/

$blogOptions = [
	 'prefix' => '/',
	 'controller' => 'Blog',
	 'middleware' => ['Config']
];

$app->route->group($blogOptions, function ($route) {
    
    // Blog routes
	$route->add('/', 'Home'); # Home Page
	$route->add('/category/:text/:id', 'Category');
	$route->add('/post/:text/:id', 'Post');
	$route->add('/post/:text/:id/add-comment', 'Post@addComment', 'POST');
	$route->add('/register', 'Register');
	$route->add('/register/submit', 'Register@submit', 'POST');
	$route->add('/login', 'Login');
	$route->add('/login/submit', 'Login@submit', 'POST');
	$route->add('/logout', 'Logout');

});




////////////////////////////////////////////////////////////////////////////////////


/*
|---------------------------------------------
|          NOT FOUND ROUTES / PAGES
|          This is a common url for all scripts
|---------------------------------------------
*/
$app->route->add('/404', 'NotFound');
$app->route->notFound('/404');