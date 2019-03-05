<?php 

/**
|- Handling Cookies
|-
|- Prerequisites
|- What are cookies
|-
|- Cookie Class
|-
|- Properties
|-
|- private \System\Application $app
|-
|- Methods
|-
|- Cookie::set('name' , 'John' , 60);
|- public void set(string $key, mixed $value, int $minutes) : Add New Cookies
|- public mixed get(string $key, mixed $default = null) : Get The Cookie Value
|- public bool has(string $key) : Determine if the given key exists in 
|- public void remove(string $key) : remove the given key from cookies
|- public array all() : Get all cookies
|- public void destroy() : Remove All Cookies
--
|-
|-