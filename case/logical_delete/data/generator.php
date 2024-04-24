#!/usr/bin/env php
<?php
declare(strict_types=1);
require_once(__DIR__ . '/../../../vendor/autoload.php');

$caseDir = __DIR__ . '/..';
$initDir = $caseDir . '/init';
$schemaFile = $caseDir . '/data/schema.sql';
$outputFile = $caseDir . '/init/data.sql';

if (!is_dir($initDir)) {
    mkdir($initDir);
}

$schema = file_get_contents($schemaFile);
file_put_contents($outputFile, $schema);

$faker = Faker\Factory::create();
$file = fopen($outputFile, "a");

for ($i = 0; $i <2; $i++) {
    fwrite($file, <<<SQL
\n
INSERT INTO `baseline` (`message`, `created_at`) VALUES

SQL);

    for ($j = 0; $j < 100000; $j++) {
        $message = addslashes($faker->realText(200));
        $createdAt = $faker->date('Y-m-d H:i:s');

        $comma = $j < 99999 ? "," : ";";

        fwrite($file, "('{$message}', '{$createdAt}')$comma\n");
    }
}

for ($i = 0; $i <2; $i++) {
    fwrite($file, <<<SQL
\n
INSERT INTO `flag_column` (`message`, `created_at`, `is_deleted`) VALUES

SQL);

    for ($j = 0; $j < 100000; $j++) {
        $message = addslashes($faker->realText(200));
        $createdAt = $faker->date('Y-m-d H:i:s');
        $is_deleted = (int)$faker->boolean;

        $comma = $j < 99999 ? "," : ";";

        fwrite($file, "('{$message}', '{$createdAt}', {$is_deleted})$comma\n");
    }
}

fwrite($file, <<<SQL
\n
INSERT INTO `timestamp_master` (`delete_timestamp`) VALUES ('2000-12-31 23:59:59');
SQL);

for ($i = 0; $i <2; $i++) {
    fwrite($file, <<<SQL
\n
INSERT INTO `timestamp_slave` (`message`, `created_at`) VALUES

SQL);

    for ($j = 0; $j < 100000; $j++) {
        $message = addslashes($faker->realText(200));
        $createdAt = $faker->date('Y-m-d H:i:s');

        $comma = $j < 99999 ? "," : ";";

        fwrite($file, "('{$message}', '{$createdAt}')$comma\n");
    }
}

fclose($file);

echo "SQL fie for initialization is generated\n";