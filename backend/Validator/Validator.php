<?php

namespace App\Validator;

class Validator
{
    public static function validate($payload, $fieldList)
    {
        $missingFields = [];

        foreach($fieldList as $field) {
            if (!isset($payload[$field])) {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields: ' . implode(', ', $missingFields)]);
            exit;
        }
    }
}