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

    public function getWeekNumber(): string
    {
        $start = new \DateTime('1900-01-01');
        $transactionDate = new \DateTime($this->operationDate);
        $daysElapsed = $transactionDate->diff($start);

        return ceil($daysElapsed->format('%a') / 7);

//        return date('W', strtotime($this->operationDate));
    }

    public function getYear(): string
    {
        return date('Y', strtotime($this->operationDate));
    }
}
