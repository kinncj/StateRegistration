<?php

namespace StateRegistration\Validator\Exception;

class InvalidParameterException extends \RuntimeException
{
    public function __construct($parameterPassed)
    {
        parent::__construct("Unable to find a validator with {$parameterPassed} argument");
    }
}
