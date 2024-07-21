<?php

namespace App\Validator\Event;

use App\Validator\Validator;

class ShowRequestValidator extends Validator
{
    private static $fieldList = ['id'];

    public static function validate($payload, $fieldList = null)
    {
        if ($fieldList == null) {
            $fieldList = self::$fieldList;
        }
        parent::validate($payload, $fieldList);
    }
}