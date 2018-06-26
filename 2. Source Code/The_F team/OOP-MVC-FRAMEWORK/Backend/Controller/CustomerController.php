<?php 
include_once "Libs/Controller.Class.php";
include_once "Model/Customer.class.php";
/**
* 
*/
class CustomerController extends Controller
{
	private $data;
	public function __construct()
	{
		parent::__construct();
		$this->data = new Customer();
	}
	public function actionIndex()
	{
		$this->model = $this->data->getData();
		$this->render('Index');
	}

	public function actionCustomerCreate()
	{
		$this->render('CustomerCreate');
	}
	
	public function actionCustomerDetail()
	{
		$this->render('CustomerDetail');
	}
	
}

 ?>