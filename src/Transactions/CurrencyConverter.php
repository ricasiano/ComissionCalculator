<?php

namespace CommissionCalculator\Transactions;

use CommissionCalculator\Transactions\CurrencyRates\CurrencyRate;

class CurrencyConverter
{
    private $currencyRate;
    private $operationAmount;

    public function __construct(CurrencyRate $currencyRate, OperationAmount $operationAmount)
    {
        $this->currencyRate = $currencyRate->getConversionRate();
        $this->operationAmount = $operationAmount->getOperationAmount();
    }

    public function computeConvertedAmount()
    {
        return (float) $this->currencyRate * $this->operationAmount;
    }
}
