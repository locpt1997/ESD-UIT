<?php 

include_once "Libs/Model.Class.php";

/**
 * 		
 */
class Invoice_Item extends Model
{
	public function getDataById($id)
	{
		$query = "SELECT * FROM " . get_class($this) . " WHERE Invoice_id = '$id';";

		try 
		{
			return $this->connect->query($query)->fetchAll(PDO::FETCH_OBJ);
		} 
		catch (Exception $e) 
		{
			die('Error in database plz check!');
		}
	}
}

 ?>