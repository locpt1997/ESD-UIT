<?php 

class Lecop  
{
	
	static public function debug($value='')
	{
		echo "<pre>",print_r($value),"</pre><br>";
	}
	public static function formatMoney($money)
	{
		$temp = strrev($money);

		$result = ltrim(strrev(chunk_split($temp,3,",")),',');

		return $result;
	}
}
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
// $_SESSION["time_out1"] = date_create();
$_SESSION["time_out2"] = date_create();

Lecop::debug($_SESSION["time_out1"]);
Lecop::debug($_SESSION["time_out2"]);
$time_out = date_diff($_SESSION["time_out2"],$_SESSION["time_out1"]);
Lecop::debug($time_out) . "<br>";
// echo $time_out->format('%R%s years');
echo $time_out->m;
 echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
 ?>