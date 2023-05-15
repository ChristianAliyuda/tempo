<?php
if($_ENV['APP_DEBUG']===true || $_ENV['APP_DEBUG']=='true' || $_ENV['APP_DEBUG']==1){
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}

date_default_timezone_set($_ENV['APP_TIMEZONE'] ?? 'UTC');

//APPLICATION
define("APP_TITLE",$_ENV['APP_NAME'] ?? "FRAMEORK");
define('PRE_FIX' , APP_TITLE);
define("BASE_URL",$_ENV['APP_URL'] ??  'http://localhost:8000');
define("IMAGE_BASE_URL",BASE_URL);