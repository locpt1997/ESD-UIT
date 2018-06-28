<?php 
include_once "Libs/Controller.Class.php";
include_once "Libs/Lecop.Class.php";
include_once "Model/Invoice.class.php";
include_once "Model/Customer.class.php";
include_once "Model/Invoice_Item.class.php";
include_once "Model/Product.class.php";
/**
* 
*/
class InvoiceController extends Controller
{
	private $data;
	public function __construct()
	{
		parent::__construct();
		$this->data = new Invoice();
	}
	public function actionIndex()
	{
		$this->model = $this->data->getData();
		$this->render('Index');
	}

	public function actionInvoiceCreate()
	{
		$this->render('InvoiceCreate');
	}
	
	public function actionInvoiceDetail()
	{
		$invoice = new Invoice();
		$customer = new Customer();
		$invoice_item = new Invoice_Item();
		if (isset($_GET['Id'])) 
		{
			$this->model[0] = $invoice->getDataById(addslashes($_GET['Id']));
			$this->model[1] = $customer->getDataById($this->model[0][0]->Customer_Id);
			$this->model[2] = $invoice_item->getDataById(addslashes($_GET['Id']));
		}
		$this->render('InvoiceDetail');
	}
	
}

 ?>