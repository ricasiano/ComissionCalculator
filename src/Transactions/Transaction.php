<?php
namespace CommissionCalculator\Transactions;

use CommissionCalculator\Transactions\CurrencyRates\CurrencyFactory;

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
        $currencyFactory = new CurrencyFactory($data[4]);
        $this->currency = $currencyFactory->createCurrency();
    }
}