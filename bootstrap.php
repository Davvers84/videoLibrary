<?php
/**
 * Created by PhpStorm.
 * User: michaeldavenport
 * Date: 01/11/18
 * Time: 11:02
 */
require __DIR__ . '/vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    "driver" => getenv('DB_CONNECTION'),
    "host" => getenv('DB_HOST'),
    "database" => getenv('DB_DATABASE'),
    "username" => getenv('DB_USERNAME'),
    "password" => getenv('DB_PASSWORD')
]);

//Make this Capsule instance available globally.
$capsule->setAsGlobal();

// Setup the Eloquent ORM.
$capsule->bootEloquent();