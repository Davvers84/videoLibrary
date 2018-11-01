<?php
/**
 * Created by PhpStorm.
 * User: michaeldavenport
 * Date: 01/11/18
 * Time: 13:37
 */
if($argv[1] == "migrate") {
    $option = "migrate";
} else if($argv[1] == "rollback") {
    $option = "rollback";
}
$databaseMigrations = array(
    "create_users_table"
    , "linked_social_accounts_table"
);

foreach($databaseMigrations as $migration) {
    $command = __DIR__ . "/{$migration}.php {$option}";
    echo "Running {$command} \r\n";
    $output = shell_exec("php {$command}");
    echo "{$output}\r\n";
}
