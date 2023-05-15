<?php namespace app\Controllers\Api;

use app\Controllers\Api\Controller;
use app\Helpers\Request;
use app\Helpers\JWT;

class AuthController extends Controller
{	
	public function login(Request $request){
		$request->validate([
			'email' => ['req','email'],
			'password' => ['str','min:6','max:18']
		]);
		
		$request->password=sha1($request->password);
		$user=$this->db->where('email',$request->email)
			->where('password',$request->password)->first('users');
		if(!$user)
			$this->response->json(["status"=>400,"message"=>"Credentials are incorrect"]);
		$user->token=JWT::generateToken($user->id);
		$this->response->json(["status"=>200,"message"=>"Logged in successfully",'data'=>$user]);
	}

	public function register(Request $request){
		$request->validate([
			'email' => ['req','email','uniq:users'],  
			'password' => ['req','str','min:6','confirmed']
		]);

		$request->password=sha1($request->password);
		$request->unset(['password_confirmation','tiks','status']);
		$user=$this->db->table('users')->insert($request->all());
		if(!$user)
			$this->response->json(["status"=>400,"message"=>"Ooops user could not be created"]);
		$user->token=JWT::generateToken($user->id);
		$this->response->json(["status"=>200,"message"=>"Registered successfully",'data'=>$user]);
	}
	 
}
