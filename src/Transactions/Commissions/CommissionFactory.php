<?php

namespace CommissionCalculator\Transactions\Commissions;

use CommissionCalculator\Transactions\Commissions\CashIn\DefaultCommission;

class CommissionFactory
{
    private $transactionType;
    private $userType;
    public function __construct($transactionType, $userType)
    {
    }

    public function createCommission()
    {

    }
}
