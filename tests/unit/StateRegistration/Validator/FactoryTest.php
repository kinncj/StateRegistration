<?php

require_once dirname(__FILE__)."/../../../../Validator/Factory.php";
require_once dirname(__FILE__)."/../../../../Validator/Acre.php";

class FactoryTest extends PHPUnit_Framework_TestCase
{
    public function testShouldReturnSpecificImplementation()
    {
        $specificImplementation = \StateRegistration\Validator\Factory::getValidator("AC");

        $this->assertEquals(new Acre, $specificImplementation);
    }
}
