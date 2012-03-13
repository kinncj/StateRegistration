<?php

class FactoryTest extends PHPUnit_Framework_TestCase
{
    public function testShouldReturnSpecificImplementation()
    {
        $specificImplementation = StateRegistration\Validator\Factory::getValidator("AC");

        $this->assertInstanceOf("StateRegistration\Validator\Acre", $specificImplementation);
    }

    /**
     * @expectedException StateRegistration\Validator\Exception\InvalidParameterException
     */
    public function testShouldThrowAnExceptionWhenAnInvalidParameterIsPassedToFactory()
    {
        $specificImplementation = StateRegistration\Validator\Factory::getValidator("Invalid");
    }
}
