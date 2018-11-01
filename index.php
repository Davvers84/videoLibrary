<?php
/**
 * Created by PhpStorm.
 * User: michaeldavenport
 * Date: 31/10/18
 * Time: 15:34
 */
require __DIR__ . '/vendor/autoload.php';
define('ROOTPATH', __DIR__);

Use eftec\bladeone\BladeOne;
use Vibrary\Controllers\RouteController;
$route = new RouteController();

$views = ROOTPATH . '/views';
$cache = ROOTPATH . '/cache';
$blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);
echo $blade->run($route->view,$route->data);