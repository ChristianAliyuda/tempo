<?php namespace app\Helpers;
use app\Helpers\Response;
use app\Helpers\Validator;
/**
 * Class Request
 *
 * @author  Talha tahir <talhabhatti0257@gmail.com>
 * @package app
 */
class Request{
	public $validated=[];

	public function __construct(){
		if(strtolower($_SERVER['REQUEST_METHOD'])!="get"){
			if(!empty($_POST)){
				$this->dataInput = (object)$_POST;
			}else{
				$this->dataInput=json_decode(file_get_contents('php://input'));
			}

			foreach($_FILES  as $key => $val){
				if($val && (isset($val['name']) && $val['name']) || (isset($val[0]['name']) && $val[0]['name']) )
					$this->createProperty($key,$val);
			}
		}else{
			$this->dataInput = (object)$_GET;
		}
		if(isset($this->dataInput->csrf_token))
			unset($this->dataInput->csrf_token);

		if(!empty($this->dataInput)){
			foreach($this->dataInput as $key => $val){
				$this->createProperty($key,$val);
			}
		}	
    }

	public function createProperty($key, $value){
        $this->{$key} = $value;
    }

	public function only($arr){
		if(is_string($arr))
			$return[$arr]=$this->{$arr} ??null;
		else if(is_array($arr))
		{
			foreach($arr as $item){
				$return[$item]= $this->{$item} ??null;
			}
		}		
		return $return;
	}
	
	public function except($arr){
		if(is_string($arr))
			$arr[$arr]=$arr;
		else if(is_array($arr)){
			foreach($this as $key => $val){
				if( !in_array($key,$arr) && !is_object(($this->{$key})) && !is_array(($this->{$key})) )
					$return[$key]= $this->{$key};
			}	
		}		
		return $return;
	}

	public function all($validated=false){
		$all=[];
		foreach($this as $key => $val){
		  if(!is_object(($this->{$key})) && $key!='dataInput'){
		      if($validated===true){
				    $all[$key]= $this->{$key};
			}else{
				if($key!=='validated' )
					$all[$key]= $this->{$key};
			}
		  }
		}
		return $all;
	}
	
	public function validated(){
		foreach($this->validated as $key)
			$validated[$key]=null;
			
		foreach($this as $key => $val){
			if(in_array($key,$this->validated)){
				$validated[$key]=$this->{$key};
			}
		}
		return $validated;
	}

	public function input($key,$default=null){
		return $this->{$key} ?? $default;
	}

	public function file($key){
		$file=$this->{$key} ?? null;
		if($file && isset($file['name']))
			return $file;
		return null;
	}

	public function hasFile($key){
		$file=$this->{$key} ?? null;
		if($file && is_array($file) && isset($file['name']) && isset($file['tmp_name']) && $file['name'] && $file['tmp_name'] )
			return true;
		return false;
	}

	public function unset($arr){
		if(is_string($arr)){
			if(isset($this->{$arr})){
				unset($this->dataInput->{$arr});
				unset($this->{$arr});
			}
		}
		else if(is_array($arr))
		{
			foreach($arr as $item){
				if(isset($this->{$item})){
					unset($this->dataInput->{$item});
					unset($this->{$item});
				}
			}
		}
	}


	public function validate($rules,$maxIndexes=40){
		$input=$this->all(true);  $errors=[];

		if($input && is_numeric($maxIndexes) && sizeof($input)>$maxIndexes)
			$errors[]="Input cannot contain more than $maxIndexes items";
			
		else if(!$rules || empty($rules))
			$errors[]='Rules Array cannot be empty';
			
		if(empty($errors)){
			$validator=new Validator();
			$errors=$validator->validate($input,$rules);
		}
		
		if(!empty($errors)){
			if(strpos($_SERVER['REQUEST_URI'],'api')!==false || strpos($_SERVER['REQUEST_URI'],'webservices')!==false){
				die(Response::json(['status'=>400,'message'=>$errors[0]]));
			}else{
				$this->sendBackWithErrors($errors);
			}
		}

		foreach($rules as $key => $value){
			$this->validated[]= $key;
		}
	}
	
	public function upload($file,$path,$type="any")
	 {
	     if(!is_array($file))
	        $file=$this->{$file};
	        
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

	public function sendBackWithErrors($errors){
		$_SESSION['ot_errors']=$errors;
		if(is_array($errors))
			$_SESSION['ot_error']=$errors[0] ?? null;
		redirectBack();
	}

	public function filterArray($array){
		return $data = array_filter($array, "filterArray");
   }
	
}