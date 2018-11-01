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
    Capsule::schema()->create('linked_social_accounts', function ($table) {
        $table->increments('id');
        $table->bigInteger('user_id');
        $table->string('provider_name')->nullable();
        $table->string('provider_id')->unique()->nullable();
        $table->timestamps();
    });
    echo 'linked_social_accounts table migrated...';
} else if($argv[1] == "rollback") {
    Capsule::schema()->dropIfExists('linked_social_accounts');
    echo 'linked_social_accounts table dropped...';
}