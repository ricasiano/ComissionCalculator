<?php
namespace CommissionCalculator\CurrencyRates;

interface CurrencyRate
{
    public function getConversionRate();
}