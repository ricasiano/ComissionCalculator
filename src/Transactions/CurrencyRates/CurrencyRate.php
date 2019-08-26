<?php
namespace CommissionCalculator\Transactions\CurrencyRates;

interface CurrencyRate
{
    public function getConversionRate();
}