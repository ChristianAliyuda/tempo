 <?php 
 require_once 'vendor/autoload.php';
 class FCM
{
    protected $db;
	function __construct()
	{ 
	    $this->db=new DB();
	} 
	
	public function sendToSingle($id,$title,$body){
	    $user=$this->db->getSingleRowIfMatch("users",'user_id',$id);
	    if($user)
	    {
	        $token=$user['fcm_token'];
    	    if($token)
    	       return $this->sendNotification($token,$title,$body);
	    }
	}
	
	public function sendNotification($token,$title,$body)
	{
		// Instantiate the client with the project api_token and sender_id.
		$client = new \Fcm\FcmClient(FCM_SERVER_KEY,FCM_SENDER_ID);

		// Instantiate the push notification request object.
		$notification = new \Fcm\Push\Notification();

		// Enhance the notification object with our custom options.
		$notification
			->addRecipient($token)
			->setTitle($title)
			->setBody($body)
			->addData('title',$title)
			->addData('body',$body);
			$result=$client->send($notification);
			if($result['success'])
			    return true;
		    return false;
	}
	 
}
