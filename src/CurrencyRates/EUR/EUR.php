<?php
namespace CommissionCalculator\CurrencyRates\EUR;

use CommissionCalculator\CurrencyRates\CurrencyRate;

class EUR implements CurrencyRate
{
    const CONVERSION_RATE = 1;

    public function getConversionRate()
    {
        return self::CONVERSION_RATE;
    }
}