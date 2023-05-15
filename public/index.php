<?php
if (class_exists('Memcached')) {
	session_module_name('memcached');
	session_save_path('920980.digitalocean.prod.memcachier.com');
	// ini_set('session.save_handler', 'memcached');
	ini_set('memcached.sess_binary', 1);
	ini_set('memcached.sess_sasl_username', 'B6CC65');
	ini_set('memcached.sess_sasl_password', 'D930E52B88F76781C8D1151843D94A05');
	// ini_set('session.save_path', 'PERSISTENT=myapp_session 920980.digitalocean.prod.memcachier.com');
}


require_once __DIR__ . "/../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$dotenv->required('APP_NAME');
$dotenv->required('APP_DEBUG');
$dotenv->required('APP_URL');
$dotenv->required('DB_HOST');

// @ini_set('session.gc_maxlifetime', ($_ENV['SESSION_LIFETIME'] ?? 365 * 24 * 60) * 60);
// @ini_set('session.cookie_lifetime', ($_ENV['SESSION_LIFETIME'] ?? 365 * 24 * 60) * 60);
@session_start();
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../config/auth.php";
require_once __DIR__ . "/../config/builtin_functions.php";

use app\Helpers\Router;
use app\Helpers\Response;

$ROUTE = $_SERVER['REQUEST_URI'] ?? '/';
if (strpos($ROUTE, '?') !== false)
	$ROUTE = substr($ROUTE, 0, strpos($ROUTE, '?'));

if (strpos($ROUTE, '/public/') !== false)
	$ROUTE = ltrim(stristr($ROUTE, 'public'), 'public');

define('PRE_ROUTE_API', 'api');
define('PRE_ROUTE_ADMIN', 'dashboard');

$router = new Router();

if ($ROUTE === "/" . PRE_ROUTE_ADMIN  ||  strpos($ROUTE, '/' . PRE_ROUTE_ADMIN . '/') !== false) {
	$ROUTE = str_replace(PRE_ROUTE_ADMIN, "", $ROUTE);
	$ROUTE = str_replace("//", "/", $ROUTE);
	define('ROUTE', $ROUTE);
	require_once "../routes/dashboard.php";
} else if ($ROUTE === "/" . PRE_ROUTE_API || strpos($ROUTE, '/' . PRE_ROUTE_API . '/') !== false) {
	$ROUTE = str_replace(PRE_ROUTE_API, "", $ROUTE);
	$ROUTE = str_replace("//", "/", $ROUTE);
	define('ROUTE', $ROUTE);
	require_once "../routes/api.php";
} else {
	define('ROUTE', $ROUTE);
	require_once '../routes/web.php';
}

if (defined('MATCHED_ROUTE'))
	$ROUTE = MATCHED_ROUTE;


$router->resolve();
