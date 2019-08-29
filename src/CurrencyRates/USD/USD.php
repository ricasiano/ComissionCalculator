<?php
namespace CommissionCalculator\CurrencyRates\USD;

use CommissionCalculator\CurrencyRates\CurrencyRate;

class USD implements CurrencyRate
{
    const CONVERSION_RATE = 1;

    public function getConversionRate()
    {
        return self::CONVERSION_RATE;
    }
}