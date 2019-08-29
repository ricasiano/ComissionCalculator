<?php
namespace CommissionCalculator\CurrencyRates;

class CurrencyRateFactory
{
    const CURRENCY_NAMESPACE = "CommissionCalculator\\CurrencyRates\\";
    private $originalCurrency;
    private $targetCurrency;
    private $classCurrency;


    public function __construct($originalCurrency, $targetCurrency)
    {
        $this->originalCurrency = strtoupper($originalCurrency);
        $this->targetCurrency = strtoupper($targetCurrency);
        $this->classCurrency = self::CURRENCY_NAMESPACE . $this->originalCurrency . "\\" . $this->targetCurrency;
        $this->validateCurrency();
    }

    private function validateCurrency()
    {

        if (!class_exists($this->classCurrency)) {
            throw new InvalidCurrencyException;
        }
    }

    public function createCurrencyRate(): CurrencyRate
    {
        return new $this->classCurrency();
    }
}