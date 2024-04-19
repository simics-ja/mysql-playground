#!/usr/bin/env php
<?php
declare(strict_types=1);
require_once(__DIR__ . '/../vendor/autoload.php');

use Lib\PathUtility;

if (!isset($argv[1])) {
    echo 'Error: Please specify a case with 1st argument.';
    exit(1);
}
$caseName = '/' . PathUtility::trimLeftSlash(PathUtility::trimRightSlash($argv[1]));
$caseInitPath = PROJECT_ROOT . '/case' . $caseName . '/init';
if (!is_dir($caseInitPath)) {
    echo "Error: The '{$caseInitPath}' doesn't exit.";
    exit(1);
}

$symlinkPath = PROJECT_ROOT . '/init';
if (is_link($symlinkPath)) {
    unlink($symlinkPath);
}
echo "Set init source: {$caseInitPath}\n";
symlink($caseInitPath, $symlinkPath);
