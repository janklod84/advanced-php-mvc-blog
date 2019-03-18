<?php  
/*
|---------------------------------------------
|          WHITE LIST ROUTES
|---------------------------------------------
*/

$app = app();


/*
|---------------------------------------------
|          ADMIN ROUTES http://localhost/blog/admin
|---------------------------------------------
*/

$adminOptions = [
	 'prefix' => '/admin',
	 'controller' => 'Admin',
	 'middleware' => ['Admin\\Auth', 'Admin\\Config']
];

$app->route->group($adminOptions, function ($route) {
    

        /*
		|---------------------------------------------
		|          ADMIN DASHBOARD ROUTES
		|---------------------------------------------
		*/

		$route->add('/' , 'Dashboard');
		


		/*
		 |---------------------------------------------
		 |          ADMIN USERS ROUTES [ CRUD ]
		 |---------------------------------------------
		*/
		$route->package('/users', 'Users');


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
		$route->package('/users-groups', 'UsersGroups');


		/*
		|---------------------------------------------
		|          ADMIN CATEGORIES ROUTES
		|          it's will be converted to /admin/categories
		|          Categories => Admin/Categories
		|---------------------------------------------
		*/
        $route->package('/categories', 'Categories');
		



		/*
		|---------------------------------------------
		|          ADMIN POSTS ROUTES
		|---------------------------------------------
		*/
        $route->package('/posts', 'Posts');
		


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
        $route->package('/ads', 'Ads');


        /*
		 |---------------------------------------------
		 |          ADMIN SETTINGS ROUTES
		 |---------------------------------------------
		*/
		$route->add('/settings', 'Settings');
		$route->add('/settings/save', 'Settings@save', 'POST');


        /*
		 |---------------------------------------------
		 |          ADMIN ROUTES
		 |---------------------------------------------
	    */
		$route->add('/login', 'Login');
		$route->add('/login/submit', 'Login@submit', 'POST');


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
		
		// url with the prefix `/` => // category/:text/:id
		// url with the prefix `/` => /category/:text/:id
		$route->add('/category/:text/:id', 'Category');
		$route->add('/post/:text/:id', 'Post');
		$route->add('/post/:text/:id/add-comment', 'Post@addComment', 'POST');
		$route->add('/register', 'Register');
		$route->add('/register/submit', 'Register@submit', 'POST');
		$route->add('/login', 'Login');
		$route->add('/login/submit', 'Login@submit', 'POST');
		$route->add('/logout', 'Logout');
        $route->add('/:any', 'Home'); # http://localhost/blog/bla/bla/bla
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