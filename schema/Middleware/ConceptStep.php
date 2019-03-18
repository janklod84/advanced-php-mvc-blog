<?php 
|- 1 We creates the next flag
|- 2 We creates the Middleware directory in the App Directory 
|- 3 We creates a Middleware interface that all middlewares should implement it
|- 4 We need to add another parameter in the add() method that accept middleware
-> Route Class
|- 5 We need know to check before running the current route if it has any middlewares