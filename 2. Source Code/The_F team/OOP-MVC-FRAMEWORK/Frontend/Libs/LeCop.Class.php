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
	static public function sendSMS($phone = '', $content = 'Cảm ơn bạn đã sử dụng dịch vụ')
	{
		$APIKey="15D7B6FD58436FB5EB1EEB93D09627";
		$SecretKey="193F38325C2806DC94CC7BFCFD8C2A";
		$YourPhone= $phone;

		$SendContent=urlencode($content);
		$data="http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$YourPhone&ApiKey=$APIKey&SecretKey=$SecretKey&Content=$SendContent&SmsType=7";

		$curl = curl_init($data); 
		curl_setopt($curl, CURLOPT_FAILONERROR, true); 
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		$result = curl_exec($curl); 
		
		$obj = json_decode($result,true);
		
		if($obj['CodeResult']==100)
		{
			return true;
		}
		else
		{
			return false;
		}

	}

}
 ?>