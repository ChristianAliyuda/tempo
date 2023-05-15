<?php
use app\Helpers\JWT;
use app\Controllers\Api\AuthController;
use app\Controllers\Api\UserController;
use app\Controllers\Api\PlatformController;

//AUTH
$router->post('/login', [AuthController::class, 'login']);
$router->post('/register', [AuthController::class, 'register']);

$router->get('/profile', [UserController::class, 'profile']);
$router->auth("jwt", function ($router){
	//$router->get('/profile', [UserController::class, 'profile']);
});

?>