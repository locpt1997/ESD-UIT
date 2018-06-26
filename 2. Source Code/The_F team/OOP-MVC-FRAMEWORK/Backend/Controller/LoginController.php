<?php 
include_once "Libs/Controller.Class.php";
include_once "Model/Admin.Class.php";
/**
* 
*/
class LoginController extends Controller
{
	function __construct()
	{
		$this->model = new Admin();
		session_start();
	}
	public function actionIndex()
	{
		if (isset($_POST["Admin_User_Name"]) || isset($_POST["Admin_Password"])) 
		{
			if ($this->model->checkLogin($_POST["Admin_User_Name"], sha1($_POST["Admin_Password"])) === '1') 
			{
				// Set sessin
				$_SESSION["Admin_Id"] = $_POST["Admin_User_Name"];

				echo $_SESSION["Admin_Id"];

				// Redirect index
				header('location:.');
			}
			else $this->status = 'loginFalse';
		}
		$this->render('Index');
	}
	public function actionLogout()
	{
		// remove all session variables
		session_unset();

		// destroy the session
		session_destroy(); 

		// Redirect Login page
		header('location:?Controller=Login');
	}
	public function actionRegister()
	{
		if (isset($_POST["Admin_Name"]) || isset($_POST["Admin_Phone"]) || isset($_POST["Admin_Mail"])  || isset($_POST["Admin_Password"]) || isset($_POST["confirm_admin_password"])) 
		{
			if ($_POST["Admin_Mail"] === "") 
			{
				$this->status = 'emtyMail';
			}elseif ($_POST["Admin_Password"] === "") 
			{
				$this->status = 'emtyPassword';
			}
			elseif (sha1($_POST["Admin_Password"]) !== sha1($_POST["confirm_admin_password"])) 
			{
				$this->status = 'false';
			}	
			elseif ($this->model->checkExistData($_POST["Admin_Mail"]) === '1') 
			{
				$this->status = 'existUser';
			}
			else
			{
				$field = array
				(
					'Admin_Id ' => $_POST["Admin_Mail"], 
					'Admin_Name' => $_POST["Admin_Name"],
					'Admin_Phone' => $_POST["Admin_Phone"], 
					'Admin_Mail' => $_POST["Admin_Mail"], 
					'Admin_User_Name' => $_POST["Admin_Mail"], 
					'Admin_Password' => sha1($_POST["Admin_Password"])
				);
				$this->model->insertData($field);

				header('location:?Controller=Login&status=Register completed');
				die();
			}
		}
		$this->render('Register');
	}
	public function actionForgotpassword()
	{
		$this->render('Forgotpassword');
	}
}

 ?>