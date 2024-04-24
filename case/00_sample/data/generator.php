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

$file = fopen($outputFile, "a");
fwrite($file, <<<SQL
\n
INSERT INTO `user` (`email`, `name`, `age`, `created_at`) VALUES

SQL);

// Generate 100,000 records
$faker = Faker\Factory::create();
for ($i = 0; $i < 100000; $i++) {
    $email = addslashes($faker->email);
    $name = addslashes($faker->name);
    $age = $faker->numberBetween(18, 100);
    $createdAt = $faker->date('Y-m-d H:i:s');

    $comma = $i < 99999 ? "," : ";";

    fwrite($file, "('$email', '$name', $age, '$createdAt')$comma\n");
}

fclose($file);

echo "SQL fie for initialization is generated\n";