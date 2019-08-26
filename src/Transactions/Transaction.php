<?php
namespace CommissionCalculator\Transactions;

use CommissionCalculator\Transactions\CurrencyRates\CurrencyRateFactory;
use CommissionCalculator\Transactions\CurrencyRates\JPY\EUR;

class Transaction
{
    private $operationDate;
    private $userId;
    private $userType;
    private $operationType;
    private $operationAmount;
    private $currency;
    private $convertedAmount;

    public function __construct(array $data)
    {
        $this->operationDate = new OperationDate($data[0]);
        $this->userId = new UserId($data[1]);
        $this->userType = $data[2];
        $this->operationType = $data[3];
        $this->operationAmount = new OperationAmount($data[3]);
        $currencyRateFactory = new CurrencyRateFactory($data[4], 'EUR');
        $this->currency = $currencyRateFactory->createCurrencyRate();
    }
}