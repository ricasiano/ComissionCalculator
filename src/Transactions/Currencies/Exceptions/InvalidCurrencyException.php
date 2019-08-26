<?php
namespace CommissionCalculator\Transactions\Currencies\Exceptions;

use \Exception;

class InvalidCurrencyException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid currency was provided for this transaction.');
    }
}