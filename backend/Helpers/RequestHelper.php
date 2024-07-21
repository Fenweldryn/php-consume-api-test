<?php

namespace App\Helpers;

class RequestHelper
{
    public static function getPayload()
    {
        $payload = json_decode(file_get_contents('php://input'), true);
        return self::sanitize($payload);
    }

    public static function sanitize($payload): array
    {
        array_walk($payload, function ($value, $key) {
            $payload[$key] = trim($value);
            $payload[$key] = stripslashes($value);
            $payload[$key] = htmlspecialchars($value);
        });

        return $payload;
    }
}