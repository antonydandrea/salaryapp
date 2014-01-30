<?php
require_once 'bootstrap.php';
use SalaryApp\BonusManager;
use SalaryApp\SalaryManager;

if (!isset($argv[1])) {
    die("Path of output file expected as argument.");
}

