<?php

namespace app\Helpers;

/**
 * Class Router
 *
 * @author  Talha tahir <talhabhatti0257@gmail.com>
 * @package app
 */
class CURL
{
    public function __construct()
    {
      
    }
	
	public static function request($url,$data=[],$method="GET"){
		$headers = [
			  "Accept: application/json",
			  "Content-Type: application/json",
			  //"api-key: ".API_KEY." "
		  ];

		$data = $data;

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		if($data)
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$return = curl_exec($ch);
	   
		$json_data = json_decode($return, true);
		$curl_error = curl_error($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		return $json_data;
	}

}