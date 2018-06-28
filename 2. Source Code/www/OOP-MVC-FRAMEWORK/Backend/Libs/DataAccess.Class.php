<?php 
/**
* 	Connect database
*/
class DataAccess  
{
	static protected $connection;

	static private $dsn = "mysql:host=localhost;dbname=thietkehethong;charset=utf8";
	static private $username = "root";
	static private $password = "";

	// Connect database
	static public function connect()
	{
		try 
		{
			self::$connection = new PDO(self::$dsn, self::$username, self::$password);
			// set the PDO error mode to exception
			self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return self::$connection;

		}
		catch(PDOException $e)
		{
			die("Error in database, Plz check!");
		}
	}

	// Close connect
	static public function close()
	{
		self::$connection = null;
	}
}
 ?>