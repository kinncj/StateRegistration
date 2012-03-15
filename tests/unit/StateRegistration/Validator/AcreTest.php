<?php

class AcreTest extends PHPUnit_Framework_TestCase
{
    public function testShouldReturnTrueWhenAStateRegistrationNumberHasThirteenDigits()
    {
        $acre = StateRegistration\Validator\Factory::getValidator("AC");
        $result = $acre->isValid("0100482300112");

        $this->assertTrue($result);
    }

    public function testShouldReturnFalseWhenAStateRegistrationNumberHasLessThanThirteenDigits()
    {
        $acre = StateRegistration\Validator\Factory::getValidator("AC");
        $result = $acre->isValid("111111111111");

        $this->assertFalse($result);
    }

    public function testShouldReturnFalseWhenAStateRegistrationNumberHasMoreThanThirteenDigits()
    {
        $acre = StateRegistration\Validator\Factory::getValidator("AC");
        $result = $acre->isValid("11111111111111111");

        $this->assertFalse($result);
    }

    /**
     * @expectedException UnexpectedValueException
     */
    public function testShouldThrowAnExceptionWhenAStateRegistrationNumberIsNotNumeric()
    {
        $acre = StateRegistration\Validator\Factory::getValidator("AC");
        $result = $acre->isValid("111111111111aaaa");
    }

    public function testShouldReturnTrueWhenAStateRegistrationNumberHasTwoFirstDigitsAreZeroAndOne()
    {
        $acre = StateRegistration\Validator\Factory::getValidator("AC");
        $result = $acre->isValid("0100482300112");

        $this->assertTrue($result);
    }

    public function testShouldReturnTrueWhenAStateRegistrationNumberDoesNotHaveTwoFirstDigitsAreZeroAndOne()
    {
        $acre = StateRegistration\Validator\Factory::getValidator("AC");
        $result = $acre->isValid("1111111111111");

        $this->assertFalse($result);
    }

    public function testShouldReturnTrueWhenCheckDigitsAreValid()
    {
        $checkDigits = "12";
        $acre = StateRegistration\Validator\Factory::getValidator("AC");
        $result = $acre->isValid("01004823001".$checkDigits);

        $this->assertTrue($result);
    }

    public function testShouldReturnFalseWhenCheckDigitsAreInvalid()
    {
        $checkDigits = "11";
        $acre = StateRegistration\Validator\Factory::getValidator("AC");
        $result = $acre->isValid("01004823001".$checkDigits);

        $this->assertFalse($result);
    }
}
