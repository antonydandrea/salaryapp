<?php
require_once 'bootstrap.php';
use SalaryApp\DateProcessor;
use SalaryApp\ConfigController;
use SalaryApp\Output;

if (!isset($argv[1])) {
    die("Path of output file expected as argument.");
} else {
    $outputFilePath = $argv[1];
}

$configController = new ConfigController("config.yml");
$settings = $configController->getConfigSettingsAsArray();

$year = $settings['year'];
$next_weekday = $settings['next_weekday'];
$expense_day_1 = $settings['first_expense_month_day'];
$expense_day_2 = $settings['second_expense_month_day'];
        
$dates = array();
$dateProcessor = new DateProcessor();

for ($month = 1; $month <= 12; $month++) {
    $firstExpenseDate = $dateProcessor->processExpenseDay("$year-$month-$expense_day_1", $next_weekday);
    $secondExpenseDate = $dateProcessor->processExpenseDay("$year-$month-$expense_day_2", $next_weekday);
    $salaryDate = $dateProcessor->processSalaryDay ($year, $month);
    $monthName = $dateProcessor->getMonthName($month);
    $dates[$monthName] = array ($firstExpenseDate, $secondExpenseDate, $salaryDate);
}

$output = new Output($outputFilePath);
$output->writeOutputFile($dates);