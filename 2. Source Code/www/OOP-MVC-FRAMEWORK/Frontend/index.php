<?php 
	// Default Controller and Action
	$Controller = isset($_GET['Controller']) ? $Controller = $_GET['Controller'] : 'Site';
	$Action = isset($_GET['Action']) ? $Action = $_GET['Action'] : 'Index';


	$controller_class = $Controller . 'Controller';
	$controller_action = 'action' . $Action;

	$controller_file_path = "controller/". $controller_class .".php";

	if (is_file($controller_file_path)) 
	{
		include_once($controller_file_path);

		// Gọi controller
		$controller = new $controller_class();

		$controller->$controller_action();
	}
	else
	{
		die("Url not found!");
	}
	

?>