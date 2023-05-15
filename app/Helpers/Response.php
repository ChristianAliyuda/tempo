<?php namespace app\Helpers;

class Response
{
	 public static function json($data=NULL,$httpRespCode=0){
		if($httpRespCode && is_numeric($httpRespCode) && $httpRespCode>99 && $httpRespCode<505)
			http_response_code($httpRespCode);
		//header('Content-Type: application/json');
		 //print_r(json_encode($res,JSON_UNESCAPED_UNICODE));
		 print_r(json_encode($data)); die;
	 }
	 	 
	  public  function success($message="",$data=NULL,$httpRespCode=0){
		 http_response_code(200);
		 header('Content-Type: application/json');
		 $res= array( 'status'=>200,'message'=> $message,'data'=>$data);
		 print_r(json_encode($res));
		 die;
	 }
	 
	 public  function successMessage($message="",$httpRespCode=0){
		http_response_code(200);
		$res= array( 'status'=>200,'message'=> $message);
		print_r(json_encode($res)); die;
	 }
	 
	public function error($message="",$httpRespCode=0){
		if($httpRespCode && is_numeric($httpRespCode))
			http_response_code($httpRespCode);
		 $res= array( 'status'=>400,'message'=> $message);
		 print_r(json_encode($res));die;
	 }
	 
	 public function unauthorized($message=""){
		 http_response_code(401);
		 $res= array( 'status'=>401,'message'=> $message);
		 print_r(json_encode($res));
		 die;
	 }
	 
	 
    private function utf8_converter($array)
	{
		array_walk_recursive($array, function(&$item, $key){
			if(!mb_detect_encoding($item, 'utf-8', true)){
				$item = utf8_encode($item);
			}
		});
		return $array;
	}
}