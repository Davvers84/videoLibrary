<?php
/**
 * Created by PhpStorm.
 * User: michaeldavenport
 * Date: 31/10/18
 * Time: 15:34
 */

error_reporting(E_ERROR | E_PARSE); // As had an warning with Guzzle that I don't have time to fix

session_start();

define('ROOTPATH', __DIR__ . '/..');
require ROOTPATH . '/vendor/autoload.php';

Use eftec\bladeone\BladeOne;
use Vibrary\Controllers\RouteController;

// Load Environment Vars
$dotenv = new Dotenv\Dotenv(ROOTPATH);
$dotenv->load();

// Routing
$route = new RouteController();

// Display View
$views = ROOTPATH . '/resources/views';
$cache = ROOTPATH . '/resources/cache';
$blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

// Cross Site Security Token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$route->data['token'] =  $_SESSION['token'];
echo $blade->run($route->view, $route->data);