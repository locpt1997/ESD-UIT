<?php 

/**
* 
*/
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

 ?>