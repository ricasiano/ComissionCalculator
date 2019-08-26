<?php
namespace CommissionCalculator\Transactions\CurrencyRates;

use CommissionCalculator\Transactions\CurrencyRates\Exceptions\InvalidCurrencyException;

class CurrencyRateFactory
{
    const CURRENCY_NAMESPACE = "CommissionCalculator\\Transactions\\CurrencyRates\\";
    private $originalCurrency;
    private $targetCurrency;


    public function __construct(string $originalCurrency, string $targetCurrency)
    {
        $this->originalCurrency = strtoupper($originalCurrency);
        $this->targetCurrency = strtoupper($targetCurrency);
        $this->validateCurrency();
    }

    private function validateCurrency()
    {
        if (!class_exists(self::CURRENCY_NAMESPACE . $this->originalCurrency . "\\" . $this->targetCurrency)) {
            throw new InvalidCurrencyException;
        }
    }

    public function createCurrencyRate()
    {
        $classCurrency = self::CURRENCY_NAMESPACE . $this->originalCurrency . "\\" . $this->targetCurrency;
        return new $classCurrency();
    }
}