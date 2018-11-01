<?php
/**
 * Created by PhpStorm.
 * User: michaeldavenport
 * Date: 01/11/18
 * Time: 13:21
 */

require __DIR__ . '/../bootstrap.php';

use Illuminate\Database\Capsule\Manager as Capsule;
if($argv[1] == "migrate") {
    Capsule::schema()->create('users', function ($table) {
        $table->increments('id');
        $table->string('name');
        $table->string('email')->unique()->nullable();
        $table->string('password')->nullable();
        $table->rememberToken();
        $table->timestamps();
    });
    echo 'users table migrated...';
} else if($argv[1] == "rollback") {
    Capsule::schema()->dropIfExists('users');
    echo 'users table dropped...';
}