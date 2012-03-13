<?php

namespace StateRegistration\Validator;

require_once dirname(__FILE__)."/bootstrap.php";

use StateRegistration\Validator;

class Acre implements ValidatorInterface
{
    public function validate($stateRegistrationNumber)
    {
        return null;
    }
}
