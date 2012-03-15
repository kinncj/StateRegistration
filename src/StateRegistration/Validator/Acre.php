<?php

namespace StateRegistration\Validator;

require_once dirname(__FILE__)."/bootstrap.php";

use StateRegistration\Validator;

class Acre implements ValidatorInterface
{
    const DIGIT_COUNT = 13;
    const FIRST_TWO_DIGITS = "01";
    const CHECK_DIGIT_COUNT = 2;
    
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
            if ($this->areFirstTwoDigitsValid()) {
                return $this->validateCheckDigits();
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

    private function validateCheckDigits()
    {
        $checkDigits = substr($this->stateRegistrationNumber, (self::DIGIT_COUNT - self::CHECK_DIGIT_COUNT), self::CHECK_DIGIT_COUNT);
        $stateRegistrationNumberWithoutCheckDigits = substr($this->stateRegistrationNumber, 0, strlen($this->stateRegistrationNumber) - self::CHECK_DIGIT_COUNT);

        $weight1 = array(4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
        $weight2 = array(5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
        
        $firstDigit = $this->calculateDigit($stateRegistrationNumberWithoutCheckDigits, $weight1);

        $stateRegistrationNumberWithOneDigit = $stateRegistrationNumberWithoutCheckDigits.$firstDigit;

        $secondDigit = $this->calculateDigit($stateRegistrationNumberWithOneDigit, $weight2);

        if ($checkDigits == $firstDigit.$secondDigit) {
            return true;
        } else {
            return false;
        }
        
    }

    private function calculateDigit($stateRegistrationNumber, $weightList)
    {
        $counter = 0;
        $sum = 0;

        for($counter; $counter < strlen($stateRegistrationNumber); $counter++) {
            $sum += $stateRegistrationNumber[$counter] * $weightList[$counter];
        }

        $digit = 11 - intval(($sum % 11));

        if ($digit == 10 || $digit == 11) {
            $digit = 0;
        }

        return $digit;
    }
    
}
