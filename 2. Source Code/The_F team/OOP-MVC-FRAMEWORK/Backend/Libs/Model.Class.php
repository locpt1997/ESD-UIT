<?php 
include_once "DataAccess.Class.php";
/**
* 
*/
class Model  
{
	protected $connect;

	function __construct()
	{
		$this->connect = DataAccess::connect();
	}
	function __destruct()
	{
		$this->connect = DataAccess::close();
	}

// ---------------------- Check ---------------------------
	// Check exist data by Model_Id
	public function checkExistData($id=0)
	{

		$query = "SELECT COUNT(*) FROM " . get_class($this) . " WHERE " . get_class($this) . "_id = '$id';";

		try 
		{
			return $this->connect->query($query)->fetchcolumn();
		} 
		catch (Exception $e) 
		{
			die('Error in database plz check!');
		}
	}

// ---------------------- Delete ---------------------------
	// Delete data by Model_Id
	public function deleteDataById($id=0)
	{

		$query = "DELETE FROM " . get_class($this) . " WHERE " . get_class($this) . "_id = '$id';";

		try 
		{
			$this->connect->query($query);
		} 
		catch (Exception $e) 
		{
			die('Error in database plz check!');
		}
	}

// ---------------------- Insert ---------------------------
	// Insert data
	public function insertData($array=array())
	{

		$_field = '';
		$_value = '';
		foreach ($array as $field => $value) 
		{
			$_field .= $field . ', ';
			$_value .= "'" . $value . "'" . ', ';
		}

		$_field = rtrim($_field, ', ');
		$_value = rtrim($_value, ', ');

		$query = "INSERT INTO " . get_class($this) . "(id, $_field, create_time, update_time) VALUES (null, $_value, now(), now());";

		try 
		{
			$this->connect->query($query);
		} 
		catch (Exception $e) 
		{
			die('Error in database plz check!');
		}
	}

// ---------------------- Update ---------------------------
	// Update data
	public function updateData($array=array())
	{
		
		$string = '';

		foreach ($array as $field => $value) 
		{
			$string .= $field . " = '$value', ";
		}

		$string = rtrim($string, ', ');

		$query = "UPDATE " . get_class($this) . " SET update_time = now(), $string WHERE " . get_class($this) . "_id = '" . $array[get_class($this).'_Id'] . "';";

		try 
		{
			$this->connect->query($query);
		} 
		catch (Exception $e) 
		{
			die('Error in database plz check!');
		}
	}

// ---------------------- Get ---------------------------
	// Get data by Model_Id
	public function getData()
	{
		$query = "SELECT * FROM " . get_class($this) . ";";

		try 
		{
			return $this->connect->query($query)->fetchAll(PDO::FETCH_OBJ);
		} 
		catch (Exception $e) 
		{
			die('Error in database plz check!');
		}
	}
	// Get data by Model_Id
	public function getDataById($id)
	{
		$query = "SELECT * FROM " . get_class($this) . " WHERE " . get_class($this) . "_id = '$id';";

		try 
		{
			return $this->connect->query($query)->fetchAll(PDO::FETCH_OBJ);
		} 
		catch (Exception $e) 
		{
			die('Error in database plz check!');
		}
	}

	// Get next data by Id
	public function getNextDataById($id=0)
	{
		if ($id == "") 
		{
			die("Vui lòng nhập id!");
		}

		$query = "SELECT min(id) FROM " . get_class($this) . " WHERE id > (SELECT id FROM " . get_class($this) . " WHERE id = $id);";

		$pattent = 'min(id)';	

		try 
		{
			return $this->connect->query($query)->fetch(PDO::FETCH_OBJ)->$pattent;
		} 
		catch (Exception $e) 
		{
			die('Error in database plz check!');
		}

	}

	// Get previoud data by Id
	public function getPreviousDataById($id=0)
	{

		$query = "SELECT max(id) FROM " . get_class($this) . " WHERE id < (SELECT id FROM " . get_class($this) . " WHERE id = $id);";

		$pattent = 'max(id)';	

		try 
		{
			return $this->connect->query($query)->fetch(PDO::FETCH_OBJ)->$pattent;
		} 
		catch (Exception $e) 
		{
			die('Error in database plz check!');
		}
	}
}
 ?>