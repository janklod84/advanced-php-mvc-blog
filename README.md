# BUILDING Advanced PHP Framework From Scratch

# 1 / Day One: using Composer & Customer Error Handler

- Using Composer For Autoloading 

- Using Whoops For Error Handling
  google: github whoops php

  composer require filp/whoops

  github whoops for ajax


# 2 / Day Two: Restructuring config, routes and logic errors

In this Part, We are going to: 

1. Updating Config File so it will not be not just a database config file
-  We will set the whole db info in `db` key
-  New key will be presented called 'routes' that will hold the list of the other routes files

2. Creating A Separate Routes Directory
 - We will hold the main routes in /routes/index.php file
 - As we may later create new routes file based on our application
 - Why we will do this? because we need to not edit the main app basics for each new website
 - Updating Helpers file with app() function 
 - We will create a tiny function that will be responsible for getting the Application object so it can be easily called in anywhere of the application


3. Application output from the Route Class
  - Later, when we go through the middlewares
  - We will handle the output based on the route middlewares conditions as it will not be as the current simple/plain middleware which is the Call Method in the Route class

{}

Using Exceptions for all types of errors


4. Using Exceptions for all types of errors 



# 3 / Day Three: Middlewares

OK, here it is how this works:

1. If route has a middleware, then the middleware will be executed before we call the route itself.

2. If the middleware returns the NEXT flag, then we will proceed to the route action as normal.

3. If The middleware doesn't return the NEXT flag, then we'll return the value that was returned from that middleware.

4. If the route doesn't have a middleware, then we will proceed to that route immediately.

5. Now lets go to see how this will work.

