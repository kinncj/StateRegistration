<?php

require_once __DIR__.'/../vendor/Symfony/Component/ClassLoader/UniversalClassLoader.php';
$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
$loader->registerNamespace('StateRegistration', __DIR__ . "/../src/");
$loader->register();
