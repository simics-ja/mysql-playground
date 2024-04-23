#!/usr/bin/env php
<?php
declare(strict_types=1);
require_once(__DIR__ . '/../../vendor/autoload.php');

use Lib\TimeMeter;

$pdo = new PDO(MYSQL_CONFIG['dsn'], MYSQL_CONFIG['user'], MYSQL_CONFIG['password']);

$sql = <<<EOF
SELECT * FROM `user`;
EOF;

$tm = new TimeMeter();
for ($i = 0; $i < 10; $i++) {
    $tm->start();

    $stmt = $pdo->query($sql);
    
    $tm->end();
    $tm->next();
    sleep(1);
}

echo $tm->result();