<?php

namespace CommissionCalculator\Transactions\Commissions\CashOut;

use CommissionCalculator\Transactions\Commissions\AbstractCommission;
use CommissionCalculator\Transactions\CurrencyConverter;

class LegalPerson extends AbstractCommission
{
    const MINIMUM_COMMISSION = 0.5;

    private $currencyConverter;

    public function __construct(CurrencyConverter $currencyConverter)
    {
        $this->currencyConverter = $currencyConverter;
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
        return self::DEFAULT_COMMISSION_RATE * $this->currencyConverter->computeConvertedAmount();
    }
}
