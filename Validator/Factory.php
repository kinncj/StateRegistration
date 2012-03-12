<?php

namespace StateRegistration\Validator;

class Factory
{
    public static function getValidator($state)
    {
        switch ($state)
        {
            case "AC":
                return new Acre;
        }
    }
}
