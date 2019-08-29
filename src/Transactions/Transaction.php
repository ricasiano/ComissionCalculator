<?php
namespace CommissionCalculator\Transactions;

class Transaction
{
    private $operationAmount;
    private $operationDate;
    private $userId;

    public function __construct(UserId $userId, OperationAmount $operationAmount, OperationDate $operationDate)
    {
        $this->userId = $userId->getUserId();
        $this->operationAmount = $operationAmount->getOperationAmount();
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