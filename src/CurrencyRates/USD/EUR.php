<?php
namespace CommissionCalculator\CurrencyRates\USD;

use CommissionCalculator\CurrencyRates\CurrencyRate;

class EUR implements CurrencyRate
{
    const CONVERSION_RATE = 0.86979212;

    public function getConversionRate()
    {
        return self::CONVERSION_RATE;
    }
}