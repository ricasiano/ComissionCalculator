<?php
namespace CommissionCalculator\Transactions;

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
        $this->currency = $data[4];
    }
}