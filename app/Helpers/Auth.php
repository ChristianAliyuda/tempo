<?php namespace app\Helpers;

use app\Models\DB;

class Auth
{
	
	public static function user() {
		return (object) $_SESSION;
	}



	public static function adminattempt(array $creds) {
		$db=new DB();
		session_destroy();
		session_start();
		if(isset($creds['password'])){
			$creds['password']=sha1($creds['password']);
		
			
		}
		foreach ($creds as $key => $value) {
			$query=$db->where($key,$value);
		}
		$user=$query->first('admins');
		
		if($user){
			self::storeSession($user);
		}

		return $user;
	}

	
	public static function attempt(array $creds) {
		$db=new DB();
		session_destroy();
		session_start();
		if(isset($creds['password'])){
			$creds['password']=sha1($creds['password']);
		
			
		}



		foreach ($creds as $key => $value) {
			$query=$db->where($key,$value);
		}
		$user=$query->first('users');
		
		if($user){
			self::storeSession($user);
		}

		return $user;
	}
	
	public static function storeSession($user){
		
		if(strpos($_SERVER['REQUEST_URI'],PRE_ROUTE_ADMIN)!==false){
			$_SESSION[PRE_FIX.'_'.'admin_id']=$user->id;
		}else{
			$_SESSION[PRE_FIX.'_'.'user_id']=$user->id;
		}
			
		$_SESSION['name']=$user->name ?? null;
	}
	
	
}