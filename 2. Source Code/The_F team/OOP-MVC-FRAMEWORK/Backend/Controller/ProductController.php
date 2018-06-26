<?php 
include_once "Libs/Controller.Class.php";
include_once "Model/Product.class.php";
/**
* 
*/
class ProductController extends Controller
{
	private $data;
	public function __construct()
	{
		parent::__construct();
		$this->data = new Product();
	}
	public function actionIndex()
	{
		if (isset($_GET['id_delete'])) 
		{
            $this->data->deleteDataById($_GET['id_delete']);

            $this->data->deleteImageById($_GET['id_delete']);
        }

		$this->model = $this->data->getData();
		$this->render('Index');
	}

	public function actionProductCreate()
	{
		if ( isset($_POST['Product_Id']) && isset($_POST['Product_Cost']) && isset($_POST['Product_Instock']) && isset($_POST['Product_Name']) && isset($_POST['Product_Description']) ) 
		{
			$product_img_array = $_FILES["product_image_link"];
			
			$numrow = $this->data->checkExistData($_POST['Product_Id']);
			// Exist product
			if ($numrow) 
			{
				$this->status = "existProduct";
			}
			// Not exist
			else
			{
				// Insert
				$field = array
				(
					'Product_Id' => $_POST['Product_Id'], 
					'Product_Cost' => $_POST['Product_Cost'], 
					'Product_Instock' => $_POST['Product_Instock'], 
					'Product_Name' => $_POST['Product_Name'], 
					'Product_Description' => $_POST['Product_Description'], 
				);
				$this->data->insertData($field);

				// Insert image and move image to sever
                 // Move file to sever
                if ($product_img_array['name']['0'] !== "") 
                {
                    // Combine 2 array to 1, for handling value
                    foreach (array_combine($product_img_array['name'], $product_img_array['tmp_name']) as $product_img_name => $product_img_path) 
                    {
                        // Define path to save image in sever 
                        $path_save_to_sever = "../Common/Images". $_POST['Product_Id'] . $product_img_name;

                        // Move image to sever
                        move_uploaded_file($product_img_path, $path_save_to_sever);

                        // Insert image to database
                        $this->data->insertProductImages($_POST['Product_Id'], $path_save_to_sever);
                    }
                }
                header("location:?Controller=Product&status=insertCompleted");
                die();
			}
		}
		$this->render('ProductCreate');
	}
	
	public function actionProductDetail()
	{
		if (isset($_GET["Id"])) 
		{
			$id = $_GET["Id"];
		}

		// Check Request to delete image
        if (isset($_GET['ImageLink'])) 
        {
            $this->	data->deleteImageByLink($_GET['Id'],$_GET['ImageLink']);
        }

        // Insert Product
        if ( isset($_POST['Product_Id']) && isset($_POST['Product_Cost']) && isset($_POST['Product_Instock']) && isset($_POST['Product_Name']) && isset($_POST['Product_Description']) ) 
		{
			$product_img_array = $_FILES["product_image_link"];
			
			// Update
			$field = array
			(
				'Product_Id' => $_POST['Product_Id'], 
				'Product_Cost' => $_POST['Product_Cost'], 
				'Product_Instock' => $_POST['Product_Instock'], 
				'Product_Name' => $_POST['Product_Name'], 
				'Product_Description' => $_POST['Product_Description'], 
			);

			$this->data->updateData($field);

			// Insert image and move image to sever
             // Move file to sever
            if ($product_img_array['name']['0'] !== "") 
            {
                // Combine 2 array to 1, for handling value
                foreach (array_combine($product_img_array['name'], $product_img_array['tmp_name']) as $product_img_name => $product_img_path) 
                {
                    // Define path to save image in sever 
                    $path_save_to_sever = "../Common/Images". $_POST['Product_Id'] . $product_img_name;

                    // Move image to sever
                    move_uploaded_file($product_img_path, $path_save_to_sever);

                    // Insert image to database
                    $this->data->insertProductImages($_POST['Product_Id'], $path_save_to_sever);
                }
            }
            $this->status = 'updateComplete';
		}

		$this->model = $this->data->getDataById($id);
			$this->model[1] = $this->data->getDataByProductImagesId($id);
	        // $this->model[2] = $this->data->getPreviousDataById($_GET['Id']);
	        // $this->model[3] = $this->data->getNextDataById($_GET['Id']);
		$this->render('ProductDetail');
	}
	
}

 ?>