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
$realCasePath = PROJECT_ROOT . '/case' . $caseName;
if (!is_dir($realCasePath)) {
    echo "Error: The '{$realCasePath}' doesn't exit.";
    exit(1);
}

$symbolicCasePath = PROJECT_ROOT . '/current_case';
if (is_link($symbolicCasePath)) {
    unlink($symbolicCasePath);
}
echo "Set init source: {$realCasePath}\n";
symlink($realCasePath, $symbolicCasePath);
