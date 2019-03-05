<?php 
namespace System;

/**
 * @package \System\Test
 */
class Test 
{

	 public function __construct()
	 {
	 	 echo __METHOD__.'<br>';
	 	 echo "I'am from ". __FILE__;
	 }
}