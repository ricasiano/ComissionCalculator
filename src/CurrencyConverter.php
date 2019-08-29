<?php

namespace CommissionCalculator;

use CommissionCalculator\CurrencyRates\CurrencyRate;

class CurrencyConverter
{
    private $currencyRate;
    private $amount;

    public function __construct(CurrencyRate $currencyRate, $amount)
    {
        $this->currencyRate = $currencyRate->getConversionRate();
        $this->amount = $amount;
    }

    public function computeConvertedAmount()
    {
        return (float) $this->currencyRate * $this->amount;
    }
}
