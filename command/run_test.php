#!/usr/bin/env php
<?php
declare(strict_types=1);
require_once(__DIR__ . '/../vendor/autoload.php');

if (!is_dir(PROJECT_ROOT . '/current_case')) {
    echo 'Error: The current_case directory does not exist. Please execute the command/set_case.php first.';
    exit(1);
}

if (!isset($argv[1])) {
    $scriptPath = PROJECT_ROOT . '/current_case/test/main.php';
} else {
    $scriptPath = PROJECT_ROOT . '/current_case/test/' . $argv[1] . (str_ends_with($argv[1], ".php") ? "" : ".php");
}

echo $scriptPath . "\n";

if (!is_file($scriptPath)) {
    echo 'Error: The test file does not exist.';
    exit(1);
}

require_once($scriptPath);
exit(0);
