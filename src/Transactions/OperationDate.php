<?php

namespace CommissionCalculator\Transactions;

use CommissionCalculator\Transactions\Exceptions\InvalidDateException;

class OperationDate
{
    private $validStartDateRange = '1900-01-01';
    private $validEndDateRange = '2100-01-01';
    private $operationDate;

    public function __construct($operationDate)
    {
        $this->operationDate = $operationDate;
        $this->checkIfDateIsValid();
    }

    private function checkIfDateIsValid()
    {
        if (strtotime($this->operationDate) < strtotime($this->validStartDateRange) ||
            strtotime($this->operationDate) > strtotime($this->validEndDateRange)) {
            throw new InvalidDateException;
        }
    }

    public function __toString()
    {
        return $this->operationDate;
    }
}
