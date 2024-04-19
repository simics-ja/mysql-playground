<?php
declare(strict_types=1);

namespace Lib;

class PathUtility {
    public static function trimRightSlash(string $path): string {
        return rtrim($path, "/\\");
    }

    public static function trimLeftSlash(string $path): string {
        return ltrim($path, "/\\");
    }
}
