<?php
namespace CommissionCalculator\Transactions;

class Transactions extends \SplObjectStorage
{
    public static function attachTransaction($transaction)
    {
        self::attach($transaction);
    }
}