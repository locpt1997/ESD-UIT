<?php 

include_once "Libs/Model.Class.php";

/**
* 		
*/
class Product extends Model
{
	public function insertProductImages($product_id, $path_save_to_sever)
	{
		$query = "INSERT INTO `product_images`(`id`, `Product_Id`, `product_image_link`) VALUES (null,'$product_id','$path_save_to_sever');";

		try 
		{
			$this->connect->query($query);
		} 
		catch (Exception $e) 
		{
			die('Error in database plz check!');
		}
	}

	// Get * from product_images by id
	public function getDataByProductImagesId($id)
	{
		$Query = "SELECT * FROM product_images WHERE product_id = '$id';";

		try 
		{
			return $this->connect->Query($Query)->fetchAll(PDO::FETCH_OBJ);
		} 
		catch (Exception $e) 
		{
			die('Error in database plz check!');
		}
	}

	// Delete image by id 
	public function deleteImageById($id)
	{
		// Delete file in sever
		$arrayLink = $this->getDataByProductImagesId($id);

		foreach ($arrayLink as $image) 
		{
			// Delete file in sever
			if (is_file($image->product_image_link)) {
				unlink($image->product_image_link);
			}
			
		}
		
		// Delete record in database
		$query = "DELETE FROM product_images WHERE Product_Id = '$id'";

		try 
		{
			$this->connect->query($query);
		} 
		catch (Exception $e) 
		{
			die('Error in database plz check!');
		}	
	}

	// Delete image by id and link
	public function deleteImageByLink($id, $link)
	{
		$query = "DELETE FROM product_images WHERE Product_Id = '$id' AND product_image_link = '$link';";

		// Delete file in sever
		if (is_file($link)) {
			unlink($link);
		}
		
		try 
		{
			$this->connect->query($query);
		} 
		catch (Exception $e) 
		{
			die('Error in database plz check!');
		}	
	}
}

 ?>