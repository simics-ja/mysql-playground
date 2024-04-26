#!/usr/bin/env php
<?php
declare(strict_types=1);
require_once(__DIR__ . '/../../../vendor/autoload.php');

use Lib\BulkInsertSQLGenerator;

$caseDir = __DIR__ . '/..';
$initDir = $caseDir . '/init';
$schemaFile = $caseDir . '/data/schema.sql';
$outputFile = $caseDir . '/init/data.sql';

if (!is_dir($initDir)) {
    mkdir($initDir);
}

$schema = file_get_contents($schemaFile);
file_put_contents($outputFile, $schema);

$generator = new BulkInsertSQLGenerator(
    $outputFile,
    'user',
    ['email', 'name', 'age', 'created_at']
);

$faker = Faker\Factory::create();

for ($i = 0; $i < 200000; $i++) {
    $email = addslashes($faker->email);
    $name = addslashes($faker->name);
    $age = $faker->numberBetween(18, 100);
    $createdAt = $faker->date('Y-m-d H:i:s');

    $generator->writeValues([$email, $name, $age, $createdAt]);
}

$generator->flush();

echo "SQL fie for initialization is generated\n";