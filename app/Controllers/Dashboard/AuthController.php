<?php namespace app\Controllers\Dashboard;

use app\Controllers\Dashboard\Controller;
use app\Helpers\Auth;
use app\Helpers\Request;

class AuthController extends Controller
{

	public function login(Request $request){
		$this->helper->validateCSRF();
		$request->validate([
			'email' => ['req','email'],
			'password' => ['str','min:6','max:18']
		]);
		
		$creds=$request->only(['email','password']);
		$user=Auth::adminattempt($creds);
		if(!$user){
			redirectWithMessage('/dashboard/login','Invalid Credentail');
		}

		
		redirect('/dashboard');
	}

public function loginpage()
{
	$this->view->render('admin/login');
}


public function logout()
{
	session_destroy();
    unset($_SESSION);
	redirect('/dashboard/login');
}
	
	
	public function register(Request $request){
		$this->helper->validateCSRF();
		$request->validate([
			'email' => ['req','email','unique:users'],
			'name' => ['req','min:3','max:48'],
			'password' => ['str','min:6','max:18']
		]);
		
		$user=$this->db->table('users')->insert(
			$request->except(['password','balance']) 
			+[
				'password' => sha1($request->password)
			]
			
		);
		Auth::storeSession($user);
		redirect('/');
	}
	
}
