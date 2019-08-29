<?php
namespace CommissionCalculator\CurrencyRates\EUR;

use CommissionCalculator\CurrencyRates\CurrencyRate;

class USD implements CurrencyRate
{
    const CONVERSION_RATE = 1.1497;

    public function getConversionRate()
    {
        return self::CONVERSION_RATE;
    }
}