<?php

namespace StateRegistration\Validator;

require_once dirname(__FILE__)."/bootstrap.php";

use StateRegistration\Validator;

class Acre implements ValidatorInterface
{
    const DIGIT_COUNT = 13;
    const FIRST_TWO_DIGITS = "01";
    
    private $stateRegistrationNumber = null;
    
    public function isValid($stateRegistrationNumber)
    {
        $this->stateRegistrationNumber = $stateRegistrationNumber;
        return $this->validate();
    }

    private function validate()
    {
        if (!$this->isTypeValid()) {
            throw new \UnexpectedValueException("State registration number must be a numeric value");
        }

        if ($this->isSizeValid()) {
            return $this->areFirstTwoDigitsValid();
        } else {
            return false;
        }
    }

    private function isTypeValid()
    {
        if (is_numeric($this->stateRegistrationNumber)) {
            return true;
        } else {
            return false;
        }
    }

    private function isSizeValid()
    {
        if (strlen($this->stateRegistrationNumber) == self::DIGIT_COUNT) {
            return true;
        } else {
            return false;
        }
    }

    private function areFirstTwoDigitsValid()
    {
        if (substr($this->stateRegistrationNumber, 0, 2) == self::FIRST_TWO_DIGITS) {
            return true;
        } else {
            return false;
        }
    }
    
}
