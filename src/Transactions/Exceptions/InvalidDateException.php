<?php
namespace CommissionCalculator\Transactions\Exceptions;

use \Exception;

class InvalidDateException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid date was provided for this transaction.');
    }
}