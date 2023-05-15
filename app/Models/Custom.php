<?php namespace app\Models;
use app\Models\DB;
class Custom
{
    protected $db;
    protected $response;
	function __construct()
	{
	    $this->db=new DB();
	    $this->conn=$this->db->getConnection();
	}
	
	public function getWebStats(){
		  $query=" Select  Count(id) as count FROM users AS t
			UNION ALL 
			Select  Count(id) as count FROM products AS t
			
			";
			$data = $this->db->getDatawithQuery($query);
			$res=[];
			if($data){
				$res['total_users']=$data[0]['count'];
				$res['total_products']=$data[1]['count'];
			}
			return $res;
	 }
	
}
