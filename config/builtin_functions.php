<?php

function redirect($path){
	echo "<script>location.href='".$path."'</script>"; die;
}


function redirectWithMessage($path,$error){
	$_SESSION['ot_message']=$error;
	redirect($path);
}

function redirectBackWithError($error){
		$_SESSION['ot_error']=$error;
		redirectBack();
	}

function redirectBack(){
	echo "<script> document.referrer ? window.history.back() : location.reload()</script>"; die;
}

function safePrint($str){
	echo htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}


function csrf(){
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32)).rand(1,9);
	echo '<input type="hidden" value="'.$_SESSION['csrf_token'].'" name="csrf_token"></input>';
}

function validateCSRF(){
	
	if(!isset($_POST['csrf']) || !isset($_SESSION['csrf']) || $_SESSION['csrf']!=$_POST['csrf'])
		die("CSRF ERROR");
	$_SESSION['csrf'] = bin2hex(random_bytes(32));
	unset($_POST['csrf']);
}

function pd($arr){
	echo "<pre>";
	print_r($arr);
	var_dump($arr);
	die;
}


function filterArray($var){
		return ($var !== NULL && $var !== FALSE && $var !== "" && $var !== "null");
}

function loadView($view){
	include __DIR__."/../Views/$view.php";
}

	
function imageExist($external_link)
{
    if (@getimagesize($external_link)) 
    {
        return 200;
    } 
    else 
    {
        return 201;
    }
}
