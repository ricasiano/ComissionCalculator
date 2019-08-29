<?php
namespace CommissionCalculator\CurrencyRates\JPY;

use CommissionCalculator\CurrencyRates\CurrencyRate;

class EUR implements CurrencyRate
{
    const CONVERSION_RATE = 0.007720219;

    public function getConversionRate()
    {
        return self::CONVERSION_RATE;
    }
}