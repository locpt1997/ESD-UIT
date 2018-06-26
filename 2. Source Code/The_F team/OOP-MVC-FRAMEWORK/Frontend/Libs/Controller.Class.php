<?php 
/**
* 
*/
class Controller  
{
	public $model;
	public $status;
	public $content;

	public function render($action)
	{
		$controller = str_replace("Controller", "", get_class($this));

		$this->content = 'View/' . $controller . '/' . $action . '.php';
        include_once 'View/Layout/' . $controller . '.php';
	}

}

 ?>