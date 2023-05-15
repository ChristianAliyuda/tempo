<?php
$allowedRoutes = ['/login'];

use app\Controllers\Dashboard\UserController;
use app\Controllers\Dashboard\AuthController;
use app\Controllers\Dashboard\IndexController;
use app\Controllers\Dashboard\LevelController;
use app\Controllers\Dashboard\ProductController;

$router->get('/login', [AuthController::class, 'loginpage']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);

$router->auth("admin", function ($router) {
    $router->get('/', [IndexController::class, 'index']);
    $router->get('/cleardata', [IndexController::class, 'cleardata']);
    $router->get('/users', [UserController::class, 'index']);
    $router->get('/todayuser', [UserController::class, 'todayuser']);
    $router->post('/AddBalance', [UserController::class, 'AddBalance']);
    $router->get('/adduser', [UserController::class, 'adduser']);
    $router->post('/adduser', [UserController::class, 'storeuser']);
    $router->get('/edituser', [UserController::class, 'edituser']);
    $router->post('/updateuser', [UserController::class, 'updateuser']);
    $router->get('/deleteUser', [UserController::class, 'deleteUser']);
    $router->get('/blockUser', [UserController::class, 'blockUser']);
    $router->get('/pendinguser', [UserController::class, 'pendingUser']);
    $router->get('/userbonus', [UserController::class, 'userbonus']);

    $router->get('/rejectedPayment', [UserController::class, 'rejectedPayment']);

    $router->get('/rejectedBonusPayment', [UserController::class, 'rejectedBonusPayment']);

    $router->get('/editwithdrawuser', [UserController::class, 'editwithdrawuser']);
    $router->post('/updatewithdrwauser', [UserController::class, 'updatewithdrwauser']);

    $router->get('/easypaisauser', [UserController::class, 'easypaisauser']);

    $router->get('/olduser', [UserController::class, 'olduser']);

    $router->get('/rejecteduser', [UserController::class, 'rejecteduser']);
    $router->get('/approvedUser', [UserController::class, 'approvedUser']);

    $router->get('/RejectedUsers', [UserController::class, 'RejectedUsers']);

    $router->get('/bonuspayments_request', [UserController::class, 'bonusPaymentsRequest']);

    $router->get('/link', [UserController::class, 'link']);

    $router->get('/levels', [LevelController::class, 'levels']);

    $router->get('/addlevel', [LevelController::class, 'addlevel']);

    $router->post('/addlevel', [LevelController::class, 'addlevels']);

    $router->get('/editlevel', [LevelController::class, 'editlevel']);

    $router->post('/editlevel', [LevelController::class, 'updatelevel']);

    $router->get('/marklink', [UserController::class, 'marklink']);

    $router->get('/payments_request', [UserController::class, 'PaymentsRequest']);

    $router->get('/approved_payments', [UserController::class, 'approvedPayments']);

    $router->get('/approvedPayment', [UserController::class, 'approvedPayment']);

    $router->get('/approvedBonusPayment', [UserController::class, 'approvedBonusPayment']);

    $router->get('/withdrawuser', [LevelController::class, 'withdrawuser']);


    $router->get('/changepassword', [UserController::class, 'changepassword']);

    $router->post('/updatepassword', [UserController::class, 'updatepassword']);


    $router->get('/setting', [UserController::class, 'setting']);
    $router->post('/updatesetting', [UserController::class, 'updatesetting']);

    $router->get('/bonus', [UserController::class, 'bonus']);
    $router->post('/updateteambonus', [UserController::class, 'updateteambonus']);

    $router->get('/teambonus', [UserController::class, 'teambonus']);

    $router->get('/products', [ProductController::class, 'index']);
    $router->get('/addproduct', [ProductController::class, 'addproduct']);
    $router->post('/addproduct', [ProductController::class, 'storeproduct']);
    $router->get('/editproducts', [ProductController::class, 'editproducts']);
    $router->post('/updateproduct', [ProductController::class, 'updateproduct']);
    $router->get('/deleteProduct', [ProductController::class, 'deleteProduct']);

    $router->get('/accounts', [UserController::class, 'accounts']);
    $router->post('/updateaccounts', [UserController::class, 'updateAccounts']);
}, '/dashboard/login');


if (defined('MATCHED_ROUTE'))
    $ROUTE = MATCHED_ROUTE;
if (!in_array($ROUTE, $allowedRoutes)) {
    if (!isset($_SESSION[PRE_FIX . 'admin_id'])) {
        redirect('dashboard/login');
    }
}
