#!/usr/bin/env php
<?php
declare(strict_types=1);
require_once(__DIR__ . '/../../vendor/autoload.php');

$pdo = new PDO(MYSQL_CONFIG['dsn'], MYSQL_CONFIG['user'], MYSQL_CONFIG['password']);

$sql = 'SELECT * FROM `user`';
$timeStart = hrtime(true);
$stmt = $pdo->query($sql);
// while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
// }
$timeEnd = hrtime(true);
$nanoSec = $timeEnd - $timeStart;
$milliSec = $nanoSec / 1000000;

echo "Time:\n $nanoSec ns\n $milliSec ms\n";