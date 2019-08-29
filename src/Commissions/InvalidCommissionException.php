<?php
namespace CommissionCalculator\Commissions;

use \Exception;

class InvalidCommissionException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid commission was retrieved for this transaction.');
    }
}