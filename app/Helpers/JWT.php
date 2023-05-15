<?php namespace app\Helpers;

/**
 * Class JWT
 *
 * @author  Talha tahir <talhabhatti0257@gmail.com>
 * @package app
 */ 
 
 use app\Helpers\Response;
 use ReallySimpleJWT\Token;
 class JWT
{
	function __construct()
	{ 
        
	} 
	
	 public static function generateToken($data)
	 {
	     if(empty($data))
	        die(" Input Data Cannot be empty in JWT::generateToken() ");
		$expiration = time() + ( ($_ENV['JWT_TTL'] ?? 43800)*60 );
		$issuer = 'localhost';
		if(is_array($data))
		{
    		$payload = [
                'iat' => time(),
                'exp' => $expiration,
                'iss' => $issuer
            ];
            $payload=array_merge($data,$payload);
            return Token::customPayload($payload,$_ENV['JWT_SECRET']);
		}
		  return Token::create($data,$_ENV['JWT_SECRET'],$expiration,$issuer);
	 }
	  public static function validateToken($token)
	 {
		return Token::validate($token,$_ENV['JWT_SECRET']);
	 }
	 
	  public static function getPayload()
	  {
		  return Token::getPayload(JWT_TOKEN,$_ENV['JWT_SECRET']);
		 
	  }
	   public function getHeader()
	  {
		 return Token::getHeader(JWT_TOKEN,$_ENV['JWT_SECRET']);
	  }
	  
	 public function refreshToken()
	 {
	     $payload=$this->getPayload();
	     if(isset($payload['iat']))
	         unset($payload['iat']);
	     if(isset($payload['exp']))
	           unset($payload['exp']);
	     if(isset($payload['iss']))
	           unset($payload['iss']);
		 return  $this->generateToken($payload);
	 }
	 
	 public function manualTokenRefresh(){
	     $payload=$this->getPayload();
	     if($payload && $payload['exp'] && ($payload['exp']-time())<3409600)
	        return $this->refreshToken();
	   else return JWT_TOKEN;
	 }
	 
	 public static function user()
	 {
	     $payload=JWT::getPayload();
		 return $payload['id'] ?? $payload['user_id'];
	 }
	 
	 public static function validateRequest(){
			
		// To VALIDATE JSON WEB TOKEN
        $headers = apache_request_headers();
        if(isset($headers['Authorization']) && strpos($headers['Authorization'], 'Bearer ')  !== false ) { 
			$headers['Authorization']=substr($headers['Authorization'],7);
			define('JWT_TOKEN',$headers['Authorization']);
		}
        elseif(isset($_GET['token']) ){ 
			define('JWT_TOKEN',$_GET['token']); 
			unset($_GET['token']);
		}
        elseif(isset($_POST['token'])){ 
			define('JWT_TOKEN',$_POST['token']); 
			unset($_POST['token']);
		}
		else
			die(Response::json(['status'=>401,'message'=>'Authorization Token Missing'],401));
       
    	if(empty(JWT_TOKEN))
			die(Response::json(['status'=>401,'message'=>'Authorization Token Missing'],401));
				
		else if(strlen(JWT_TOKEN)<64)
			die(Response::json(['status'=>401,'message'=>'Authorization Token is Invalid'],401));
				
        if(!JWT::validateToken(JWT_TOKEN))
			die(Response::json(['status'=>401,'message'=>'Authorization Token is Invalid or Expired,Permission Denied'],401));
        	
		define('LOGGED_USER',JWT::user());
	 }
	 
}

// Read About this library from https://github.com/RobDWaller/ReallySimpleJWT
