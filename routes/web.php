<?php

use app\Controllers\UserController;
use app\Controllers\IndexController;
use app\Controllers\AuthController;

use app\Models\DB;


$router->post('/login', [AuthController::class, 'login']);
$router->view('/login', 'login', null);
// $router->get('/login', [AuthController::class, 'loginpage']);
$router->get('/signup', [AuthController::class, 'signup']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/invite', [AuthController::class, 'signup']);

$router->post('/SendForgotEmail', [AuthController::class, 'SendForgotEmail']);

$router->get('/forgot_password', [AuthController::class, 'forgot_password']);
$router->get('/forget-email', [AuthController::class, 'forgot_email']);
$router->get('/reset_password', [AuthController::class, 'reset_password']);

$router->post('/reset_password', [AuthController::class, 'updatereset_password']);
$router->post('/forgetEmail', [AuthController::class, 'forgetEmail']);


$router->auth("user", function ($router) {
    $router->get('/verify', [IndexController::class, 'verify']);
    $router->get('/agrement', [IndexController::class, 'agrement']);
    $router->get('/waiting', [IndexController::class, 'waiting']);
    $router->get('/blocked', [IndexController::class, 'blocked']);
    $router->post('/updateverify', [IndexController::class, 'updateverify']);
    $router->post('/updateAgrement', [IndexController::class, 'updateAgrement']);


    if (isset($_SESSION[PRE_FIX . '_user_id'])) {
        $db = new DB();

        $user = $db->where('id', $_SESSION[PRE_FIX . '_user_id'])->first('users');

        if (empty($user->txt_id) || $user->agrement == 0) {
            redirect('/agrement');
        } else if (empty($user->txt_id) || $user->paid == 0 || $user->blocked == 1) {
            redirect('/verify');
        }
    }

    $router->get('/', [IndexController::class, 'index']);
    $router->get('/logout', [AuthController::class, 'logout']);
    $router->get('/team', [UserController::class, 'index']);
    $router->get('/work', [UserController::class, 'ads']);
    $router->get('/collectReward', [UserController::class, 'collectReward']);
    $router->get('/wallet', [UserController::class, 'wallet']);
    $router->get('/profile', [UserController::class, 'profile']);
    $router->get('/payment_request', [UserController::class, 'sendRequest']);
    $router->get('/daily_bonus', [UserController::class, 'dailybonus']);
    $router->get('/collectBonus', [UserController::class, 'collectBonus']);
    $router->get('/notification', [UserController::class, 'notification']);

    $router->get('/bonuspayment_request', [UserController::class, 'bonussendRequest']);

    $router->get('/showUserdetails', [UserController::class, 'showUserdetails']);


    $router->get('/invite_user', [UserController::class, 'invite']);
    $router->get('/setting', [UserController::class, 'setting']);

    $router->get('/permote', [UserController::class, 'permote']);

    $router->get('/message', [UserController::class, 'message']);


    $router->post('/addlink', [UserController::class, 'addlink']);



    $router->post('/updatepassword', [UserController::class, 'updatepassword']);

    $router->post('/updateAccount', [UserController::class, 'updateAccount']);

    $router->post('/updateEmail', [UserController::class, 'updateEmail']);

    $router->get('/contact', [IndexController::class, 'contacts']);

    $router->get('/about', [IndexController::class, 'about']);
    $router->get('/convertToPkr', [IndexController::class, 'convertToPkr']);
    $router->get('/amazon', [IndexController::class, 'amazon']);

    $router->get('/history', [IndexController::class, 'history']);


    $router->get('/logout', [IndexController::class, 'index']);
});
