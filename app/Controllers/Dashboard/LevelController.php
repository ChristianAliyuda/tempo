<?php namespace app\Controllers\Dashboard;

use app\Controllers\Dashboard\Controller;
use app\Helpers\Request;

class LevelController extends Controller
{
	
	
	public function levels(){

		$data=$this->db->table('levels')->get();
		$this->view->render('admin/levels', [
			'levels'=>$data
        ]);
	}

	public function withdrawuser(){

		$data=$this->db->table('withdrawuser')->get();
		$this->view->render('admin/withdrawuser', [
			'users'=>$data
        ]);
	}
	


	

	public function updatelevel(Request $request){

		$request->validate([
			'title' => ['req'],
			'total_team' => ['req','str'],
			'total_team2' => ['req','str'],
			'withdraw_limit' => ['req','str'],
			'bonus' => ['req','str'],
			'first' => ['req','str'],
		]);
		$payload=$request->validated();
		$levels=$this->db->table('levels')->where('id',$request->id)->update($payload);
		if($levels)
		{
			redirectWithMessage('/dashboard/levels','Levels Update Succeesfuly');
		}

		
	}

	public function addlevels(Request $request)
	{
		$request->validate([
			'title' => ['req'],
			'total_team' => ['req','str'],
			'total_team2' => ['req','str'],
			'withdraw_limit' => ['req','str'],
			'bonus' => ['req','str'],
			'first' => ['req','str']

		]);
		$payload=$request->validated();
		$user=$this->db->table('levels')->insert($payload);
		if($user)
		{
			redirectWithMessage('/dashboard/levels','levels Register Succeesfuly');
		}
		
	}



	public function updateuser(Request $request)
	{
		$request->validate([
			'email' => ['req','email'],
			'name' => ['req','str','min:3'],
			'phone' => ['req','str','min:11'],
			'password' => ['req','str','min:6','confirmed']

		]);
		$payload=$request->validated();
		if(isset($request->password))
		
		{
		$payload['password']=password_hash($request->password, PASSWORD_DEFAULT);
		}

		$user=$this->db->table('users')->where('id',$request->user_id)->update($payload);
		if($user)
		{
			redirectWithMessage('/dashboard/users','User Update Succeesfuly');
		}
		
	}


	public function editlevel()
	{
		$level_id=$_GET['id'];
		$data=$this->db->where('id',$level_id)->first('levels');
		$this->view->render('admin/editlevel', [
			'level'=>$data
        ]);
	}

	public function RejectedUsers()

	{
		$user_id=$_GET['user_id'];
		$user=$this->db->where('id',$user_id)->first('users');
		$payload['txtid_rejected']=1;
		$user=$this->db->table('users')->where('id',$user_id)->update($payload);
		print_r(json_encode("User Rejected Successfuly"));
	}

	public function approvedUser()
	{
		$user_id=$_GET['user_id'];
		$user=$this->db->where('id',$user_id)->first('users');
		if(!empty($user->invitee_id))
		{
		$this->addbalance($user->invitee_id);
		$total=$this->total_team($user->invitee_id);
		if($total<10)
		{
		$payloads['level_id']=1;	
		}
		if($total>9 and $total<29)
		{
		$payloads['level_id']=2;	
		}

		else if($total>29 and $total<49)
		{
		$payloads['level_id']=3;	
		}
		else if($total>49 and $total<69)
		{
		$payloads['level_id']=4;	
		}

		else if($total>69 and $total<89)
		{
		$payloads['level_id']=5;	
		}

		else if($total>89 and $total<109)
		{
		$payloads['level_id']=6;	
		}

		else if( $total>109)
		{
		$payloads['level_id']=6;	
		}
		$user=$this->db->table('users')->where('id',$user->invitee_id)->update($payloads);
		}
		$payload['approved_date']=date('Y-m-d');
		$payload['paid']=1;
		$user=$this->db->table('users')->where('id',$user_id)->update($payload);
		print_r(json_encode("User Approved Successfuly"));
	}






	public function addlevel()
	{
		
		$this->view->render('admin/addlevel');
	}
	
}
