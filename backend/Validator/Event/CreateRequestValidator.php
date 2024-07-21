<?php

namespace App\Validator\Event;

use App\Validator\Validator;

class CreateRequestValidator extends Validator
{
    private static $fieldList = ['title', 'description', 'startDate', 'endDate'];

    public static function validate($payload, $fieldList = null)
    {
        if ($fieldList == null) {
            $fieldList = self::$fieldList;
        }
        parent::validate($payload, $fieldList);
    }
}