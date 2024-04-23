<?php
declare(strict_types=1);

define('PROJECT_ROOT', realpath(__DIR__ . '/..'));
define('MYSQL_CONFIG', [
    'dsn' => 'mysql:dbname=mydb;host=127.0.0.1;port=3306',
    'user' => 'user',
    'password' => 'password',
]);