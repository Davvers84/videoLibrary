<?php
/**
 * Created by PhpStorm.
 * User: michaeldavenport
 * Date: 01/11/18
 * Time: 13:21
 */

require __DIR__ . '/../bootstrap.php';

use Illuminate\Database\Capsule\Manager as Capsule;
if(!empty($argv[1]) &&  $argv[1] == "migrate") {
    Capsule::schema()->create('videos', function ($table) {
        $table->increments('id');
        $table->integer('user_id')->unsigned()->index()->nullable();
        $table->foreign('user_id')->references('id')->on('users');
        $table->string('channelId')->nullable();
        $table->string('channelTitle')->nullable();
        $table->string('title')->nullable();
        $table->string('description')->nullable();
        $table->string('videoId')->unique();
        $table->timestamps();
    });
    echo 'videos table migrated...';
} else if(!empty($argv[1]) && $argv[1] == "rollback") {
    Capsule::schema()->dropIfExists('videos');
    echo 'videos table dropped...';
} else {
    echo "Please use 'migrate' or 'rollback' command line argument";
}
