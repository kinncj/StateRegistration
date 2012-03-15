<?php

namespace StateRegistration\Validator\Exception;

class UnexpectedTypeException extends \RuntimeException
{
    const EXCEPTION_MESSAGE = "Validator expects a numeric value";
    
    public function __construct()
    {
        parent::__construct(self::EXCEPTION_MESSAGE);
    }
}
