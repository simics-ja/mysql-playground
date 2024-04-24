#!/usr/bin/env php
<?php
declare(strict_types=1);
require_once(__DIR__ . '/../../../vendor/autoload.php');

use Lib\TimeMeter;

$pdo = new PDO(MYSQL_CONFIG['dsn'], MYSQL_CONFIG['user'], MYSQL_CONFIG['password']);

$sql = <<<SQL
SELECT * FROM `user` WHERE created_at < '2000-12-31 23:59:59';
SQL;

$tm = new TimeMeter();
for ($i = 0; $i < 5; $i++) {
    $tm->start();

    $stmt = $pdo->query($sql);
    
    $tm->end();
    $tm->next();
    sleep(1);
}

echo $tm->result();