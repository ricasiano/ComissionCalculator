<?php
namespace CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson;

use CommissionCalculator\Transactions\CurrencyConverter;
use CommissionCalculator\Transactions\UserId;
use CommissionCalculator\Transactions\OperationDate;

class AccountTransaction
{
    private $operationAmount;
    private $operationDate;
    private $userId;

    public function __construct(UserId $userId, CurrencyConverter $currencyConverter, OperationDate $operationDate)
    {
        $this->userId = $userId->getUserId();
        $this->operationAmount = $currencyConverter->computeConvertedAmount();
        $this->operationDate = $operationDate;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getOperationAmount()
    {
        return $this->operationAmount;
    }

    public function getWeekNumber()
    {
        return date('W', strtotime($this->operationDate));
    }

    public function getYear()
    {
        return date('Y', strtotime($this->operationDate));
    }
}