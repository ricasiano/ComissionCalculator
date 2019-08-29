<?php
include "vendor/autoload.php";
use CommissionCalculator\CommissionCalculator;

$data = [
  [
      '2014-12-31',4,'natural','cash_out','1200.00','EUR'
  ]
];
$commissionCalculator = new CommissionCalculator($data);
$commissionCalculator->calculate();