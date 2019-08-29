<?php
namespace CommissionCalculator\CurrencyRates\EUR;

use CommissionCalculator\CurrencyRates\CurrencyRate;

class JPY implements CurrencyRate
{
    const CONVERSION_RATE = 129.53;

    public function getConversionRate()
    {
        return self::CONVERSION_RATE;
    }
}