<?php 
namespace System\View;

use System\Application;


/**
 * @package \System\View\ViewFactory
*/
class  ViewFactory
{

	/**
	 * Application Object
	 *
	 * @var \System\Application
	*/
	private $app;


    /**
     * Constructor
     *
     * @param \System\Application $app
    */
	public function __construct(Application $app)
	{
		$this->app = $app;
	}


	/**
	 * Render the given path with the passed variables and generate 
	 * @param string $viewPath
	 * @param array $data
	 * @return \System\View\ViewInterface
	 *
	 */
	 public function render($viewPath , array $data = [])
	 {
	 	 return new View($this->app->file, $viewPath, $data);
	 }


}