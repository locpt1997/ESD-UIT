<?php 
include_once "Libs/Controller.Class.php";
/**
* 
*/
class SiteController extends Controller
{
	public function actionIndex()
	{
		$this->render('Index');
	}
	
}

 ?>