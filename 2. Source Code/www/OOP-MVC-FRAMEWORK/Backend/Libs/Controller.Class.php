<?php 
/**
* 
*/
class Controller  
{
	public $model;
	public $status;
	public $content;

	function __construct()
	{
		session_start();
		$this->checkLogin();
	}
	public function checkLogin()
	{
		if (!isset($_SESSION["Admin_Id"])) 
		{
			header('location:?Controller=Login');
		}
	}
	public function render($action)
	{
		$controller = str_replace("Controller", "", get_class($this));

		$this->content = 'View/' . $controller . '/' . $action . '.php';
        include_once 'View/Layout/' . $controller . '.php';
	}

}

 ?>