<?php 
include_once "Libs/Controller.Class.php";
include_once "Model/Product.Class.php";
include_once "Libs/Lecop.Class.php"; 
include_once "Model/Customer.Class.php"; 
include_once "Model/Invoice.Class.php"; 
include_once "Model/Invoice_Item.Class.php"; 
/**
* 
*/
class SiteController extends Controller
{
	public $data;
	public function actionIndex()
	{
		$this->data = new Product();
		$this->model = $this->data->getData();
		$this->render('Index');
	}
	public function actionProductDetail()
	{
		$this->data = new Product();
		$this->model = $this->data->getDataById($_GET['Id']);
		$this->model[1] = $this->data->getDataByProductImagesId($_GET['Id']);
		$this->render('ProductDetail');
	}
	public function actionCheckout()
	{
		session_start();
		// Set cookie
		if (isset($_POST['quantity']) && isset($_POST['Product_Id']) && isset($_POST['Product_Name']) && isset($_POST['Product_Cost'])) 
		{
			$product = array
			(
				'Product_Id' => $_POST['Product_Id'], 
				'Product_Name' => $_POST['Product_Name'], 
				'quantity' => $_POST['quantity'], 
				'Product_Cost' => $_POST['Product_Cost'], 
			);
			$js_product = json_encode($product);

			if (isset($_COOKIE['cart'])) 
			{
				$flag = 1;
				foreach ($_COOKIE['cart'] as $key ) 
				{
					$result = json_decode($key);
					if ($result->Product_Id === $_POST['Product_Id']) 
					{
						$flag = 0;
					}
				}
				// Lưu vào cookie 
				if ($flag) 
				{
					$count = count($_COOKIE['cart']);
					setcookie("cart[$count]", $js_product, time() + (86400 * 30), "/"); 
					header('Location:'.$_SERVER['REQUEST_URI']);
				}
			}
			else
			{
				// Lưu vào cookie 
				setcookie("cart[0]", $js_product, time() + (86400 * 30), "/"); 
				header('Location:'.$_SERVER['REQUEST_URI']);
			}
			
		}

		// Hangling bill
			
		if (
			isset($_SESSION['Customer_Name']) && 
			isset($_SESSION['Customer_Phone']) && 
			isset($_SESSION['Customer_Mail']) && 
			isset($_SESSION['Customer_Address']) && 
			isset($_SESSION['Bill_Note'])
			) 
		{
			$Bill_Note = addslashes($_SESSION['Bill_Note']);

			$customer_field = array
			(
				'Customer_Id' => $_SESSION["Customer_Mail"], 
				'Customer_Name' => $_SESSION["Customer_Name"], 
				'Customer_Phone' => $_SESSION["Customer_Phone"], 
				'Customer_Mail' => $_SESSION["Customer_Mail"], 
				'Customer_Address' => $_SESSION["Customer_Address"] 
			);
			$customer = new Customer();

			$count_customer = $customer->checkExistData($_SESSION['Customer_Mail']);

			if ($count_customer !== '0') 
			{
				// Update customer
				$customer->updateData($customer_field);

				$Invoice_Id = date('dmYHis');
				// insert invoice
				$invoice = new Invoice();
				$invoice_field = array
				(
					'Invoice_Id' => $Invoice_Id, 
					'Customer_Id' => $_SESSION['Customer_Mail'], 
					'Note' => $_SESSION['Bill_Note']
				);
				$invoice->insertData($invoice_field);

				$i = 0;
				// insert invoice item
				
				foreach ($_COOKIE['cart'] as $key ) 
				{
					$result = json_decode($key);

					$invoice_item[$i] = new Invoice_Item();

					$invoice_item_field = array
					(
						'Invoice_Id' => $Invoice_Id, 
						'Product_Id' => $result->Product_Id,
						'Quantity' => $result->quantity,
						'Customer_Id' => $_SESSION['Customer_Mail']
					);
					$invoice_item[$i]->insertData($invoice_item_field);

					// upate product íntock
					$product = new Product();
						// get Instock
					$instock = $product->getDataById($result->Product_Id);
						// calculate new instock
					$new_instock = $instock[0]->Product_Instock - $result->quantity;	

					$field_product = array
					(
						'Product_Id' => $result->Product_Id, 
						'Product_Instock' => $new_instock 
					);
					$product->updateData($field_product);

					// remove all cookie variables $_COOKIE['cart'][0]
					// setcookie("cart[$i]", "", time() - (86400 * 30), "/");
					setcookie("cart[$i]", "", time() - (86400 * 30), "/");				

					$i++;
				}
				// Lecop::debug($_COOKIE['cart']);
				// echo "i= " . $i . "<br>";
				// unset session
				unset($_SESSION["Customer_Name"]);
				unset($_SESSION["Customer_Phone"]);
				unset($_SESSION["Customer_Mail"]);
				unset($_SESSION["Customer_Address"]);
				unset($_SESSION["Bill_Note"]);

				// destroy all session
				session_destroy();

				// redirect
				header('location:?Action=InvoiceDetail&Invoice_Id='.$Invoice_Id);
			}
			else 
			{
				// insert customer
				$customer->insertData($customer_field);

				$Invoice_Id = date('dmYHis');
				// insert invoice
				$invoice = new Invoice();
				$invoice_field = array
				(
					'Invoice_Id' => $Invoice_Id, 
					'Customer_Id' => $_SESSION['Customer_Mail'], 
					'Note' => $_SESSION['Bill_Note']
				);
				$invoice->insertData($invoice_field);


				$i = 0;
				// insert invoice item
				
				foreach ($_COOKIE['cart'] as $key ) 
				{
					$result = json_decode($key);

					$invoice_item[$i] = new Invoice_Item();

					var_dump($result);

					$invoice_item_field = array
					(
						'Invoice_Id' => $Invoice_Id, 
						'Product_Id' => $result->Product_Id,
						'Quantity' => $result->quantity,
						'Customer_Id' => $_SESSION['Customer_Mail']
					);
					$invoice_item[$i]->insertData($invoice_item_field);

					// upate product íntock
					$product = new Product();
						// get Instock
					$instock = $product->getDataById($result->Product_Id);
						// calculate new instock
					$new_instock = $instock[0]->Product_Instock - $result->quantity;	

					$field_product = array
					(
						'Product_Id' => $result->Product_Id, 
						'Product_Instock' => $new_instock 
					);
					$product->updateData($field_product);
					
					// remove all cookie variables $_COOKIE['cart'][0]
					setcookie("cart[$i]", "", time() - (86400 * 30), "/");

					$i++;
				}
				// unset session
				unset($_SESSION["Customer_Name"]);
				unset($_SESSION["Customer_Phone"]);
				unset($_SESSION["Customer_Mail"]);
				unset($_SESSION["Customer_Address"]);
				unset($_SESSION["Bill_Note"]);

				// destroy all session
				session_destroy();
				
				// redirect
				header('location:?Action=InvoiceDetail&Invoice_Id='.$Invoice_Id);
			}
			
		}

		
		$this->render('Checkout');
	}
	public function actionCart()
	{
		$this->render('Cart');
	}
	public function actionInvoiceDetail()
	{
		$invoice = new Invoice();
		$customer = new Customer();
		$invoice_item = new Invoice_Item();

		if (isset($_GET['Invoice_Id'])) 
		{
			$this->model[0] = $invoice->getDataById(addslashes($_GET['Invoice_Id']));
			$this->model[1] = $customer->getDataById($this->model[0][0]->Customer_Id);
			$this->model[2] = $invoice_item->getDataById(addslashes($_GET['Invoice_Id']));
		}
		
		$this->render('InvoiceDetail');
	}
	public function actionVerifyInvoice()
	{
		// after redirect from checkout
		if 
		(
			isset($_POST['Customer_Name']) && 
			isset($_POST['Customer_Phone']) && 
			isset($_POST['Customer_Mail']) && 
			isset($_POST['Customer_Address']) && 
			isset($_POST['Bill_Note'])
		) 
		{
			
			session_start();

			// settime zone
			date_default_timezone_set('Asia/Ho_Chi_Minh');

			// generate code
			$_SESSION["verify_code"] = rand(100000,999999);

			// set flag time
			$_SESSION["time_out1"] = date_create();
			$_SESSION["time_out2"] = date_create();

			$content = "Để xác nhận đơn hàng, vui lòng nhập mã xác nhận: ". $_SESSION["verify_code"];
	
			
			// Save customer information to session
			$_SESSION["Customer_Name"] = addslashes($_POST['Customer_Name']);
			$_SESSION["Customer_Phone"] = addslashes($_POST['Customer_Phone']);
			$_SESSION["Customer_Mail"] = addslashes($_POST['Customer_Mail']);
			$_SESSION["Customer_Address"] = addslashes($_POST['Customer_Address']);
			$_SESSION["Bill_Note"] = addslashes($_POST['Bill_Note']);


			if (isset($_COOKIE['limit_reset_code'])) 
			{
			}
			else
			{
				// set cookie for limit reset code
				setcookie('limit_reset_code', '1', time() + (60*30), "/");
				// send sms		
				Lecop::sendSMS($_SESSION["Customer_Phone"],$content);

				header('Location:'.$_SERVER['REQUEST_URI']);	
				die();
			}			
			
		}

		// resend code
		if (isset($_GET['status']) && $_GET['status'] == 'resentCode') 
		{
			session_start();
			// generate code
			$_SESSION["verify_code"] = rand(100000,999999);

			// set flag time
			$_SESSION["time_out1"] = date_create();
			$_SESSION["time_out2"] = date_create();

			$content = "Để xác nhận đơn hàng, vui lòng nhập mã xác nhận: ". $_SESSION["verify_code"];

			if (isset($_COOKIE['limit_reset_code'])) 
			{
				
				if ($_COOKIE['limit_reset_code'] <= 3) 
				{
					// send sms		
					Lecop::sendSMS($_SESSION["Customer_Phone"],$content);
				}
				else
				{
					$this->status = 'reset_fail';
				}
				setcookie('limit_reset_code', ++$_COOKIE['limit_reset_code'], time() + (60*30), "/");
			}
			else
			{
				// set cookie for limit reset code
				setcookie('limit_reset_code', '1', time() + (60*30), "/");
				header('Location:'.$_SERVER['REQUEST_URI']);
				die();
			}
		}
		// Receive code
		if (isset($_POST['Verify_code'])) 
		{
			session_start();
			$_SESSION["time_out2"] = date_create();

			// Calculate time_out
			$time_out = date_diff($_SESSION["time_out2"],$_SESSION["time_out1"]);

			if ($time_out->y > 0) 
			{
				$this->status = 'time_out';
				// echo $this->status = 'time_out';
			}
			elseif ($time_out->m > 0) 
			{
				$this->status = 'time_out';
				// echo $this->status = 'time_out';
			}
			elseif ($time_out->d > 0) 
			{
				$this->status = 'time_out';
				// echo $this->status = 'time_out';
			}
			elseif ($time_out->h > 0) 
			{
				$this->status = 'time_out';
				// echo $this->status = 'time_out';
			}
			elseif ($time_out->i > 0) 
			{
				$this->status = 'time_out';
				// echo $this->status = 'time_out';
			}
			elseif ($time_out->s > 30) 
			{
				$this->status = 'time_out';
				// echo $this->status = 'time_out';
			}
			else
			{
				if ($_POST['Verify_code'] == $_SESSION["verify_code"] ) 
				{
					// Xóa session name
					unset($_SESSION['Verify_code']);
					unset($_SESSION['time_out1']);
					unset($_SESSION['time_out2']);
					// unset cookie
					setcookie('limit_reset_code','', time() - (60*30), "/");
					// redirect
					header('location:?Action=Checkout');
				}
				else
				{
					$this->status = 'invalid_code';
				}
			}
		}

		// Invoke view
		$this->render('VerifyInvoice');
	}
}

 ?>