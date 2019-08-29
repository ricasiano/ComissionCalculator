<?php

namespace CommissionCalculator\Commissions\CashOut;

use CommissionCalculator\Commissions\AbstractCommission;
use CommissionCalculator\Transactions\OperationAmount;

class LegalPerson extends AbstractCommission
{
    const MINIMUM_COMMISSION = 0.5;

    private $operationAmount;

    public function __construct(OperationAmount $operationAmount)
    {
        $this->operationAmount = $operationAmount;
    }

    public function computeCommission()
    {
        if (self::MINIMUM_COMMISSION > $this->getComputedAmount()) {
            return self::MINIMUM_COMMISSION;
        }

        return $this->getComputedAmount();
    }

    private function getComputedAmount()
    {
        return self::DEFAULT_COMMISSION_RATE * $this->operationAmount->getOperationAmount();
    }
}
