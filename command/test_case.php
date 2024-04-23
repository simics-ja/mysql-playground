#!/usr/bin/env php
<?php
declare(strict_types=1);
require_once(__DIR__ . '/../vendor/autoload.php');

if (!is_dir(PROJECT_ROOT . '/current_case')) {
    echo 'Error: The current_case directory does not exist. Please execute the command/set_case.php first.';
    exit(1);
}
if (!is_file(PROJECT_ROOT . '/current_case/test.php')) {
    echo 'Info: The current_case/test.php file does not exist.';
    exit(1);
}

require_once(PROJECT_ROOT . '/current_case/test.php');