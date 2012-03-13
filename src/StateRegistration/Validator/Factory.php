<?php

namespace StateRegistration\Validator;

require_once dirname(__FILE__)."/bootstrap.php";

use StateRegistration\Validator;

class Factory
{
    public static function getValidator($state)
    {
        switch ($state)
        {
            case "AC":
                return new Acre;
                break;
            default:
                throw new Exception\InvalidParameterException($state);
        }
    }
}
