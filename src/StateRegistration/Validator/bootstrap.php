<?php

require_once __DIR__.'/../../../vendor/Symfony/Component/ClassLoader/UniversalClassLoader.php';
$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
$loader->registerNamespace('StateRegistration\\Validator', __DIR__);
$loader->register();
