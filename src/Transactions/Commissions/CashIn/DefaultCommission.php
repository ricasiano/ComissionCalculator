<?php

namespace CommissionCalculator\Transactions\Commissions\CashIn;

use CommissionCalculator\Transactions\Commissions\AbstractCommission;
use CommissionCalculator\Transactions\CurrencyConverter;

class DefaultCommission extends AbstractCommission
{
    const MAX_COMMISSION = 5.00;

    private $currencyConverter;

    public function __construct(CurrencyConverter $currencyConverter)
    {
        $this->currencyConverter = $currencyConverter;
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
        return self::DEFAULT_COMMISSION_RATE * $this->currencyConverter->computeConvertedAmount();
    }
}
