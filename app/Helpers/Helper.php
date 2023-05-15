<?php
namespace app\Helpers;

class Helper{
	
	public function input(){
		$data=$this->object_to_array(json_decode(file_get_contents('php://input')));
		if(empty($data)) 
			$data=$_POST;
		return $data;
	}
	
	public function unset($input,$keys){
		if(!is_array($input))
			die("unset method expects input to be array");
			
		if(!is_array($keys))
			$keys[0]=$keys;
			
		foreach($keys as $key){
			if( $key && isset($input[$key]))
				unset($input[$key]);
		}
		
		return $input;	
		
	}
	
  
	  
	public function object_to_array($data){
		if (is_array($data) || is_object($data))
		{
			$result = array();
			foreach ($data as $key => $value)
			{
				$result[$key] = $this->object_to_array($value);
			}
			return $result;
		}
		return $data;
	}
  
  
   public function encrypt_decrypt($action, $string) 
	{
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'ery4ajvf11224vb';
		$secret_iv = 'gery2211bfhhj34hb';
		// hash
		$key = hash('sha256', $secret_key);
		
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if ( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else if( $action == 'decrypt' ) {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}
	
	function isAssocArray(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
	
	
	 public function uploadFile($file,$path,$type="any")
	 {
		 if(empty($file) || !isset($file['name']))
			 die("file Cannot be empty");
		if($type=="image")
			$extensions= ['png','jpg','jpeg','bmp','gif','svg','webp','avif'];
		else if($type=="video")
			$extensions= ['mp4','avi','flv','webm','mkv','ogv'];
		else if($type=="document" || $type=="doc")
			$extensions= ['pdf','doc','docx','txt','csv'];
		else
			$extensions= ['png','jpg','jpeg','bmp','gif','pdf','doc','docx','txt','mp4','avi','mkv','flv','webm','csv'];
		 $fileExtension=strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
		  if(in_array($fileExtension,$extensions)){
			$trailingSlash='';
			if(substr($path, -1)!=='/')  $trailingSlash='/';
    		 $filePath=$path.$trailingSlash.substr(md5(time()),0,11).rand(1001,9999).'.'.$fileExtension;
    		 
		    move_uploaded_file($file['tmp_name'],$filePath);
		}
		else
			die("illegal extension only".implode(',',$extensions)." extensions are allowed");
		return $filePath;
	 }
	 
	
	public function getVisitorIpAddr(){
		$ip = getenv('HTTP_CLIENT_IP')?:
		getenv('HTTP_X_FORWARDED_FOR')?:
		getenv('HTTP_X_FORWARDED')?:
		getenv('HTTP_FORWARDED_FOR')?:
		getenv('HTTP_FORWARDED')?:
		getenv('REMOTE_ADDR');
		return $ip;
	}
	
	
	public function filterArray($array){
		 return $data = array_filter($array, "filterArray");
	}
	
	function base64_to_jpeg($base64_string, $output_file,$back=false) {
        // open the output file for writing
		if($back)
			$output_file="../".$output_file;
        $ifp = fopen($output_file, 'wb' ); 
  
        $data = explode( ',', $base64_string );
        if(!isset($data[1]))
    		 $this->response->error("Invalid base64");
    	
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
    
        // clean up the file resource
        fclose( $ifp ); 
    
        return $output_file; 
    }
	
	
	public function validateCSRF(){
	
		if(!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || $_SESSION['csrf_token']!=$_POST['csrf_token'])
			die("CSRF ERROR");
		$_SESSION['csrf_token'] = bin2hex(random_bytes(32)).rand(1,9);
		unset($_POST['csrf_token']);
	}

	public function lower($value){
		return mb_strtolower($value, 'UTF-8');
	}

	public function upper($value){
		return mb_strtoupper($value, 'UTF-8');
	}

	public function title($value){
		return mb_convert_case($value,MB_CASE_TITLE ,'UTF-8');
	}
	
	public function generateRandomString($addRandom=false){
		$cstrong=true;
		$bytes = openssl_random_pseudo_bytes(16, $cstrong);
		$hex   = bin2hex($bytes);
		if($addRandom){
			$hex=rand(11,99).$hex;
		}
		return $hex;
	}
	
	
	
}
