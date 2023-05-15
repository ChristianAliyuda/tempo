<?php namespace app\Controllers\Api;

use app\Controllers\Api\Controller;
class UserController extends Controller
{	

	public function returnAttachmentType($attachment)
	{
		if(strpos($attachment,".mp4") !== false || strpos($attachment,".mkv") !== false || strpos($attachment,".avi") !== false
		|| strpos($attachment,".webm") !== false || strpos($attachment, ".youtu") !== false
		|| strpos($attachment,".flv") !== false  || strpos($attachment,".mov") !== false || strpos($attachment,".WMV") !== false
		)
			return "video";
		else return "image";
	}
	
	public function returnextension($attachment)
	{
		if(strpos($attachment,".mp4") !== false)
				return 'mp4';
		else if(strpos($attachment,".mov") !== false)
				return 'mov';
		else if(strpos($attachment,".png") !== false)
				return 'png';
		else if(strpos($attachment,".jpg") !== false)
				return 'jpg';
		else if(strpos($attachment,".jpeg") !== false)
				return 'jpeg';
		else if(strpos($attachment,".webm") !== false)
				return 'webm';
		else if(strpos($attachment,".tiff") !== false)
				return 'tiff';
		else if(strpos($attachment,".tif") !== false)
				return 'tif';
		
	}
	
	public function profile(){
		$categories=$this->db->table('categories')->with('subcategories')->get();
		$this->response->json(["status"=>200,"message"=>"Categories Profile",'data'=>$categories]);
		$posts=$this->db->table('posts')
		->where('attachments','!=',null)
		->where('attachments','!=','')
		->get();
		
		foreach($posts as $post){
			$type=$this->returnAttachmentType($post->attachments);
			$extension=$this->returnextension($post->attachments);
			$this->db->table('post_attachments')->insert([
				'post_id'=>$post->id,
				'path'=>$post->attachments,
				'extension'=>$extension,
				'type' => $type,
				'thumbnail' => $post->thumbnail,
				'created_at'=> $post->created_at,
				'updated_at'=> $post->updated_at
			]);
		}
		
		pd($posts);
		
		$username=$_GET['username'] ?? LOGGED_USER;
		$attr='id';
		if(!is_numeric($username))
			$attr='username';
		$user=$this->db->where($attr,$username)->first('users');
		$this->response->json(["status"=>200,"message"=>"User Profile",'data'=>$user]);
	}

	public function update(){
		$data=$this->helper->input();
		$this->helper->validate($data,[
			'email' => ['email'],  
			'password' => ['str','min:6'],
			'name' =>['str', 'min:3']
		]);
		$user=$this->db->where('id',LOGGED_USER)->first('users');
		$oldPhoto=$user['photo'];

		if(isset($data['email']) && $data['email']!=$user['email'] ){
			$duplicate=$this->db->where('email',$data['email'])->first('users');
			if($duplicate){
				$this->response->json(["status"=>400,"message"=>"Email is already taken"]);
			}
		}

		if(isset($data['username']) && $data['username']!=$user['username']){
			$duplicate=$this->db->where('username',$data['username'])->first('users');
			if($duplicate){
				$this->response->json(["status"=>400,"message"=>"Username is already taken"]);
			}
		}

		if(isset($_FILES['photo']['name']) && $_FILES['photo']['name'])
			$data['photo']=$this->helper->uploadFile($_FILES['photo'],'uploads/users','image');
		
		$user=$this->db->table('users')->where('id',LOGGED_USER)->update($data);
		if($user){
			if($oldPhoto && file_exists($oldPhoto))
				unlink($oldPhoto);
			$this->response->json(["status"=>200,"message"=>"User Updated Successfully",'data'=>$user]);
		}
		$this->response->json(["status"=>400,"message"=>"Ooops error while updating"]);
	}

	public function connect(){
		$this->helper->validate($_GET,[ 
			'id' => ['req','num','min:1'],
		]);
		$connect['connecting_id']=LOGGED_USER;
		$connect['connected_id']=$_GET['id'];
		$connected=$this->db->where('connected_id',$connect['connected_id'])
				->where('connecting_id',$connect['connecting_id'])->first('connects');
		if($connected){
			$deleted=$this->db->table('connects')->where('connected_id',$connect['connected_id'])
			->where('connecting_id',$connect['connecting_id'])->delete();
			if($deleted)
				$this->response->json(["status"=>400,"message"=>"Connection removed successfully"]);
			$this->response->json(["status"=>200,"message"=>"Ooops Could not be removed"]);
		}
		$connect=$this->db->table('connects')->insert($connect);
		if($connect)
			$this->response->json(["status"=>200,"message"=>"Connected successfully"]);
		$this->response->json(["status"=>400,"message"=>"Ooops  could not be conneted"]);
	}
	
}
