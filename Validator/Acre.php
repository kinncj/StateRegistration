<?php

namespace StateRegistration\Validator;

require_once dirname(__FILE__)."/ValidatorInterface.php";

class Acre implements \StateRegistration\ValidatorInterface\Validator
{
    public function validate($stateRegistrationNumber)
    {
        return null;
    }
}
