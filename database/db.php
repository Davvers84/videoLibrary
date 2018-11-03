<?php
/**
 * Created by PhpStorm.
 * User: michaeldavenport
 * Date: 01/11/18
 * Time: 13:37
 */
if(!empty($argv[1]) &&  $argv[1] == "migrate") {
    $option = "migrate";
} else if(!empty($argv[1]) && $argv[1] == "rollback") {
    $option = "rollback";
} else {
    echo "Please use 'migrate' or 'rollback' command line argument";
    exit;
}
$databaseMigrations = array(
    "create_users_table"
    , "create_videos_table"
);

foreach($databaseMigrations as $migration) {
    $command = __DIR__ . "/{$migration}.php {$option}";
    echo "Running {$command} \r\n";
    $output = shell_exec("php {$command}");
    echo "{$output}\r\n";
}
