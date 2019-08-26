<?php
namespace CommissionCalculator\Transactions\CurrencyRates;

abstract class AbstractCurrencyRate implements CurrencyRate
{
    const CONVERSION_RATE = 1;

    public function getConversionRate()
    {
        return self::CONVERSION_RATE;
    }
}