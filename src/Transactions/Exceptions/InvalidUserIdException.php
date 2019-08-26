<?php
namespace CommissionCalculator\Transactions\Exceptions;

use \Exception;

class InvalidUserIdException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid user ID was provided for this transaction.');
    }
}