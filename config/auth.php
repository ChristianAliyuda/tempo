<?php
use app\Helpers\JWT;
function validateSessionAuth($role='user',$view='/login'){
	if(!isset($_SESSION[PRE_FIX.'_'.$role."_id"]))
		redirect($view);
}

function validateJWTAuth($role='user',$view='/login'){	
	JWT::validateRequest();
}