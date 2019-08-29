<?php

namespace CommissionCalculator\Commissions\CashIn;

use CommissionCalculator\Commissions\AbstractCommission;
use CommissionCalculator\Transactions\OperationAmount;

class DefaultCommission extends AbstractCommission
{
    const MAX_COMMISSION = 5.00;

    private $operationAmount;

    public function __construct(OperationAmount $operationAmount)
    {
        $this->operationAmount = $operationAmount;
    }

    public function computeCommission()
    {
        $computedAmount = $this->getComputedAmount();

        if ($computedAmount > self::MAX_COMMISSION) {
            return self::MAX_COMMISSION;
        }

        return $computedAmount;
    }

    private function getComputedAmount()
    {
        return self::DEFAULT_COMMISSION_RATE * $this->operationAmount->getOperationAmount();
    }
}
