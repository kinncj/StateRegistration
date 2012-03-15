<?php

namespace StateRegistration\Validator;

require_once dirname(__FILE__)."/bootstrap.php";

use StateRegistration\Validator;

class Acre implements ValidatorInterface
{
    const TOTAL_DIGIT_COUNT = 13;
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
        $this->hasValidStructure();
        return $this->validateCheckDigits();
    }

    private function hasValidStructure()
    {
        if (!$this->isTypeValid()) {
            throw new Exception\UnexpectedTypeException("State registration number must be a numeric value");
        }

        if (!$this->isSizeValid()){
            throw new \InvalidArgumentException("State registration number must have ".self::TOTAL_DIGIT_COUNT." digits");
        }

        if (!$this->areFirstTwoDigitsValid()) {
            throw new \InvalidArgumentException("State registration number must have the two first digits equals ".self::CHECK_DIGIT_COUNT);
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
        if (strlen($this->stateRegistrationNumber) == self::TOTAL_DIGIT_COUNT) {
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
        $checkDigits = $this->getCheckDigits();
        $stateRegistrationNumberWithoutCheckDigits = $this->getStateRegistrationNumberWithoutCheckDigits();

        $weightListForFirstCheckDigit = array(4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
        $weightListForSecondCheckDigit = array(5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
        
        $firstCheckDigit = $this->calculateDigit($stateRegistrationNumberWithoutCheckDigits, $weightListForFirstCheckDigit);

        $stateRegistrationNumberWithOneCheckDigit = $stateRegistrationNumberWithoutCheckDigits.$firstCheckDigit;

        $secondCheckDigit = $this->calculateDigit($stateRegistrationNumberWithOneCheckDigit, $weightListForSecondCheckDigit);

        return $checkDigits == $firstCheckDigit.$secondCheckDigit;
    }

    private function getCheckDigits()
    {
        return substr($this->stateRegistrationNumber, (self::TOTAL_DIGIT_COUNT - self::CHECK_DIGIT_COUNT), self::CHECK_DIGIT_COUNT);
    }

    private function getStateRegistrationNumberWithoutCheckDigits()
    {
        return substr($this->stateRegistrationNumber, 0, (self::TOTAL_DIGIT_COUNT - self::CHECK_DIGIT_COUNT));
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
