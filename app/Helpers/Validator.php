<?php namespace app\Helpers;
use app\Models\DB;
use ReallySimpleJWT\Validate;

class Validator
{
    //public $validations;
    public function validate($input,$validations){
		$errors=[];
        foreach ($validations as $key => $rules) {
			
            foreach($rules as $validation)
            {
                $val=$input[$key] ?? null;
				
                //$validation=strtolower($validation);
                if( ($validation=="req" || $validation=="required") && $val===null )
                    $errors[]= $key." is required";
                
				else if( ( $validation=="email") && isset($input[$key]) && !filter_var($val, FILTER_VALIDATE_EMAIL) ) 
                    $errors[]= $key." is not valid email";
				
				//VALIDATING WHEATER FILE OR NOT
                else if( $val && $validation=="file"  && ( !is_array($val) || (!isset($val['name']) && !isset($val[0]['name']))  ))
                    $errors[]= $key." is not a file";
					
				//VALIDATING WHEATER NUMERIC OR NOT
                else if( $val && ($validation=="num" || $validation=="numeric") && !is_numeric ($val)  )
                    $errors[]= $key." is not a number";
					
				//VALIDATING WHEATER STRING OR NOT
				else if( $val && ( strtolower($validation)=="str" || strtolower($validation)=="string" || $validation=="varchar") &&  !is_string($val)  ){
					if(is_int($val) || is_double($val) || is_numeric($val))
						$errors[]= $key." cannot be a numeric value";
					else if(is_array($val))
						$errors[]= $key." cannot be an array";
					else if(is_object($val))
						$errors[]= $key." cannot be an object";
					$errors[]= $key." is not a string/Varchar value";
				}
                    
					
				//CHECKS THE MIN LENGTH/VAL
				else if($val && strpos($validation,'min:')!==false){
					$len=str_replace("min:","",$validation);
					if(is_int($val) || is_double($val)){
						if($val<$len)
							$errors[]= $key." cannot be less than ".$len;
					}else{
						if(strlen($val)<$len)
							$errors[]= $key." length cannot be less than ".$len;
					}
				}
				
				//CHECKS THE MAX LENGTH/VAL
				else if( $val && strpos($validation,'max:')!==false){
					$len=str_replace("max:","",$validation);
					if(is_int($val) || is_double($val)){
						if($val>$len)
							$errors[]= $key." cannot be greater than ".$len;
					}else{
						if(strlen($val)>$len)
							$errors[]= $key." length cannot be greater than ".$len;
					}
				}
				
				//Validate if Date
				else if( $val &&  ( strtolower($validation)=="date" || strtolower($validation)=="datetime"  )){
					 $date = date_parse($val);
					if($date['error_count'] == 0 || $date['warning_count'] == 0){
						if(!checkdate($date['month'], $date['day'], $date['year']))
							$errors[]= $key."must be a valid date";
					}else{
						$errors[]= $key." must be a valid date";
					}
				}
				
				//Validates the date format
				else if( $val && strpos($validation,'date_format:')!==false){
					$format=str_replace("date_format:","",$validation);
					if($format && !is_numeric($format)){
						$d = DateTime::createFromFormat($format, $val);
						$result=$d && $d->format($format) === $val;
						if(!$result)
							$errors[]= $key." is required in this format ".$format;
					}
				}
				
				//Validates the date time before
				else if( $val && strpos($validation,'before:')!==false){
					$time=str_replace("before:","",$validation);
					if(strtolower($time)=="today"){
						if(strtotime($val) >= strtotime(date('Y-m-d')))
							$errors[]= $key." must be before today";
					}
					else if( strtolower($time)=="tomorrow" ){
						if(strtotime($val) >= strtotime(date("Y-m-d", strtotime('tomorrow'))))
							$errors[]= $key." must be before tomorrow";
					}else{
						if(strtotime($val) >= strtotime($time))
							$errors[]= $key." must be before $time";
					}
				}
				
				
				//Validates the date time after
				else if( $val && strpos($validation,'after:')!==false){
					$time=str_replace("after:","",$validation);
					if(strtolower($time)=="today"){
						if(strtotime($val) <= strtotime(date('Y-m-d')))
							$errors[]= $key." must be after today";
					}
					else if( strtolower($time)=="tomorrow" ){
						if(strtotime($val) <= strtotime(date("Y-m-d", strtotime('tomorrow'))))
							$errors[]= $key." must be after tomorrow";
					}else{
						if(strtotime($val) <= strtotime($time))
							$errors[]= $key." must be after $time";
					}
				}

				//VALIDATING IF IN ARRAY
				else if( $val && strpos($validation,'in:')!==false){
					$arr=explode(',',str_replace("in:","",$validation));
					if(!in_array($val,$arr))
						$errors[]= "invalid ".$key." value ";
				}
				
				
				//VALIDATE CONFIRM PASSWORD
				else if( $val && strpos($validation,'confirm')!==false  ||  strpos($validation,'confirmed')!==false ){
					if(!isset($input[$key.'_confirmation'])){
						$errors[]= $key.'_confirmation is required';
					}
					else  if($input[$key]!=$input[$key.'_confirmation']){
						$errors[]= $key." and ".$key."_confirmation do not match";
					}
				}
				
				//CHECKS IF VALUE IS UNIQUE IN TABLE
				else if( $val && strpos($validation,'uniq:')!==false  ||  strpos($validation,'unique:')!==false ){
					if($val){
						$db=new DB();
						$table=str_replace("unique:","",$validation);
						$table=str_replace("uniq:","",$validation);
						if( $db->exist($table,$key,$val) )
						$errors[]= $key." is already taken";
					}
				}
				
				
            }
            
        }
		return $errors;
    }
	
	//EXAMPLE 
	/*
	$request->validate([$inputArray,
		'email' => ['req','email','uniq:users'],  // EMAIL SHOULD BE required,proper email& should be unique in users table
		'name' => ['req','str','min:6','max:16'],      //name SHOULD BE required,varchar min length should be 6 and max 16
		'user_id' => ['num','min:0']  //user_id SHOULD BE numeric value and min value should be 0
	]);*/
}

?> 