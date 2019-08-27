<?php
namespace CommissionCalculator\Transactions;

use CommissionCalculator\Transactions\Commissions\CommissionFactory;
use CommissionCalculator\Transactions\CurrencyRates\CurrencyRateFactory;

class Transaction
{
    private $operationDate;
    private $userId;
    private $userType;
    private $operationType;
    private $operationAmount;
    private $currency;

    public function __construct(array $data)
    {
        $this->operationDate = new OperationDate($data[0]);
        $this->userId = new UserId($data[1]);
        $this->userType = $data[2];
        $this->operationType = $data[3];
        $this->operationAmount = new OperationAmount($data[3]);
        $currencyRateFactory = new CurrencyRateFactory($data[4], 'EUR');
        $this->currency = $currencyRateFactory->createCurrencyRate();
        $commissionFactory = new CommissionFactory($data[3], $data[4]);
    }

    public function getOperationDate()
    {
        return $this->operationDate;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUserType()
    {
        return $this->userType;
    }

    public function getOperationType()
    {
        return $this->operationType;
    }

    public function getOperationAmount()
    {
        return $this->operationAmount;
    }

    public function getCurrency()
    {
        return $this->currency;
    }
}