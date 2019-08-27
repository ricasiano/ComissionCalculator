<?php
namespace CommissionCalculator\Transactions\TransactionTypes;

class TransactionTypeException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid transaction type.');
    }
}