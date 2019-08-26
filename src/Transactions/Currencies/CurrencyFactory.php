<?php
namespace CommissionCalculator\Transactions\Currencies;

use CommissionCalculator\Transactions\Currencies\Exceptions\InvalidCurrencyException;

class CurrencyFactory
{
    const CURRENCY_NAMESPACE = "CommissionCalculator\\Transactions\\Currencies\\";
    private $currency;


    public function __construct(string $currency)
    {
        $this->currency = strtoupper($currency);
        $this->validateCurrency();
    }

    private function validateCurrency()
    {
        if (!class_exists(self::CURRENCY_NAMESPACE . $this->currency)) {
            throw new InvalidCurrencyException;
        }
    }

    public function createCurrency()
    {
        $classCurrency = self::CURRENCY_NAMESPACE . $this->currency;

        return new $classCurrency;
    }
}