<?php

namespace StateRegistration\Validator;

require_once dirname(__FILE__)."/bootstrap.php";

use StateRegistration\Validator;

class Acre implements ValidatorInterface
{
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
            if (substr($this->stateRegistrationNumber, 0, 2) == "01") {
                return true;
            } else {
                return false;
            }
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
        if (strlen($this->stateRegistrationNumber) == 13) {
            return true;
        } else {
            return false;
        }
    }
    
}
