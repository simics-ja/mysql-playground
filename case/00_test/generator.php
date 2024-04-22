#!/usr/bin/env php
<?php
declare(strict_types=1);
require_once(__DIR__ . '/../../vendor/autoload.php');

if (!is_dir(__DIR__ . '/init')) {
    echo 'Error: The init directory does not exist.';
    exit(1);
}

$faker = Faker\Factory::create();
$file = fopen("current_case/init/01_data.sql", "w");
fwrite($file, "INSERT INTO `user` (`email`, `name`, `age`, `created_at`) VALUES\n");

// Generate 100,000 records
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