<?php
namespace CommissionCalculator\CurrencyRates\JPY;

use CommissionCalculator\CurrencyRates\CurrencyRate;

class JPY implements CurrencyRate
{
    const CONVERSION_RATE = 1;

    public function getConversionRate()
    {
        return self::CONVERSION_RATE;
    }
}