<?php

namespace CommissionCalculator\Transactions;

use CommissionCalculator\Transactions\Exceptions\InvalidAmountException;

class OperationAmount
{
    private $operationAmount;

    public function __construct($operationAmount)
    {
        $this->operationAmount = $operationAmount;
        $this->validateAmount();
    }

    private function validateAmount()
    {
        if (!is_numeric($this->operationAmount)) {
            throw new InvalidAmountException;
        }

        if (0 > $this->operationAmount) {
            throw new InvalidAmountException;
        }
    }

    public function getOperationAmount()
    {
        return (float) $this->operationAmount;
    }
}
