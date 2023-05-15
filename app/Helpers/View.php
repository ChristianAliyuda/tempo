<?php

namespace app\Helpers;

/**
 * Class Router
 *
 * @author  Talha tahir <talhabhatti0257@gmail.com>
 * @package app
 */
class View
{	
	 public static function render($view, $params = [],$layout="web"){	
        $message=$_SESSION['ot_message'] ?? null;
        $errors=$_SESSION['ot_errors'] ?? [];
        $error=$_SESSION['ot_error'] ?? null;
		if($error && empty($errors)){
			$errors[0]=$error;
		}
        if(isset($_SESSION['ot_errors']))
           unset($_SESSION['ot_errors']);
        if(isset($_SESSION['ot_error']))
           unset($_SESSION['ot_error']);
           if(isset($_SESSION['ot_message']))
           unset($_SESSION['ot_message']);
            
        foreach ($params as $key => $value) {
            $$key = $value;	
        }
		
        ob_start();
        include __DIR__."/../../Views/$view.php";
        $content = ob_get_clean();
		
        include __DIR__."/../../Views/layouts/$layout.php";
        die;
    }

    public  static function load($view, $params = []){
        $errors=$_SESSION['ot_errors'] ?? [];
        $error=$_SESSION['ot_error'] ?? null;
        if(isset($_SESSION['ot_errors']))
           unset($_SESSION['ot_errors']);
        if(isset($_SESSION['ot_error']))
           unset($_SESSION['ot_error']);
        
           
       foreach ($params as $key => $value) {
           $$key = $value;	
       }
        include __DIR__."/../../Views/$view.php"; die;
    }

}