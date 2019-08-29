<?php
include "vendor/autoload.php";
use CommissionCalculator\CommissionCalculator;


$csv = fopen('./' . $argv[1], 'r');
$data = [];

while(false !== $csvData = fgetcsv($csv)) {
    $data[] = $csvData;
}

$commissionCalculator = new CommissionCalculator($data);
$commissionCalculator->calculate();
