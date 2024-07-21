<?php

namespace App\Helpers;

class DotEnvHelper
{
    public static function load($filePath)
    {
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '#') !== 0) {
                list($key, $value) = explode('=', $line, 2);
                if (isset($value)) {
                    putenv("$key=$value");
                }
            }
        }
    }
}