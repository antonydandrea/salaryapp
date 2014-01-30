<?php
require_once 'vendor/symfony/class-loader/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();

$loader->useIncludePath(true);

$loader->registerNamespace('SalaryApp', dirname(__FILE__).'/src');

$loader->register();