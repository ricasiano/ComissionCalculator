<?php
namespace CommissionCalculator\Transactions;

use CommissionCalculator\CurrencyConverter;
use CommissionCalculator\CurrencyRates\CurrencyRateFactory;
use CommissionCalculator\Transactions\TransactionTypes\TransactionType;
use CommissionCalculator\Transactions\TransactionTypes\TransactionTypeFactory;
use CommissionCalculator\Transactions\UserTypes\UserType;
use CommissionCalculator\Transactions\UserTypes\UserTypeFactory;

class Transaction
{
    const DEFAULT_CURRENCY_FOR_COMMISSION = 'EUR';

    private $operationDate;
    private $userId;
    private $userType;
    private $transactionType;
    private $operationAmount;

    public function __construct(array $data)
    {
        $this->operationDate = new OperationDate($data[0]);
        $this->userId = new UserId($data[1]);
        $userTypeFactory = new UserTypeFactory($data[2]);
        $this->userType = $userTypeFactory->createUserType();
        $transactionTypeFactory = new TransactionTypeFactory($data[3]);
        $this->transactionType = $transactionTypeFactory->createTransactionType();
        $this->operationAmount = new OperationAmount($data[5]);
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function getOperationAmount(): OperationAmount
    {
        return $this->operationAmount;
    }

    public function getOperationDate(): OperationDate
    {
        return $this->operationDate;
    }

    public function getUserType(): UserType
    {
        return $this->userType;
    }

    public function getTransactionType(): TransactionType
    {
        return $this->transactionType;
    }
}