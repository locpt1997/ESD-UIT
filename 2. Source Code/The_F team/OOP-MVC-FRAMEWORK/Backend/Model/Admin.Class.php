<?php 

include_once "Libs/Model.Class.php";

/**
* 		
*/
class Admin extends Model
{
	
	public function checkLogin($username='', $password='')
	{
		$query = "SELECT COUNT(*) FROM " . get_class($this) . " WHERE " . get_class($this) . "_id = '$username' and " . get_class($this) . "_Password = '$password';";

		try 
		{
			return $this->connect->query($query)->fetchcolumn();
		} 
		catch (Exception $e) 
		{
			die('Error in database plz check!');
		}
	}
}

 ?>