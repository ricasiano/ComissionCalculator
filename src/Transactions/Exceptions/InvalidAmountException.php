<?php
namespace CommissionCalculator\Transactions\Exceptions;

use \Exception;

class InvalidAmountException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid amount was provided for this transaction.');
    }
}