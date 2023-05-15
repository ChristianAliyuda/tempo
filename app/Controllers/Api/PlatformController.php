<?php namespace app\Controllers\Api;

use app\Controllers\Api\Controller;
class PlatformController extends Controller
{	
	public function add(){
		$data=$this->helper->input();
		$this->helper->validate($data,[
			'path' => ['str','min:2'],  
			'platform_id' => ['num','min:1'],
			'direct' => ['in:0,1']
		]);
		$data['user_id']=LOGGED_USER;

		$platform=$this->db->where('platform_id',$data['platform_id'])
			->where('user_id',LOGGED_USER)->first('user_platforms');
		if($data['direct']==1){
			$this->db->table('user_platforms')->where('user_id',LOGGED_USER)->update(['direct'=>0]);
		}
		if($platform){
			$user_platform=$this->db->table('user_platforms')->where('id',$platform['id'])->update($data);
			if($user_platform)
				$this->response->json(["status"=>200,"message"=>"Platform updated successfully",'data'=>$user_platform]);	
		}else{
			$user_platform=$this->db->table('user_platforms')->insert($data);
			if($user_platform)
				$this->response->json(["status"=>200,"message"=>"Platform added successfully",'data'=>$user_platform]);
		}
		$this->response->json(["status"=>400,"message"=>"Ooops platform could not be added"]);
	}

	public function destroy(){
		$this->helper->validate($_GET,[ 
			'platform_id' => ['req','num','min:1'],
		]);
		$deleted=$this->db->table('user_platforms')->where('user_id',LOGGED_USER)
			->where('platform_id',$_GET['platform_id'])->delete();
		if($deleted)
			$this->response->json(["status"=>200,"message"=>"Platform removed successfully"]);
		$this->response->json(["status"=>400,"message"=>"Ooops platform could not be removed"]);
	}
}