<?php

namespace CommissionCalculator\Transactions\TransactionTypes;

class TransactionTypeFactory
{
    private $transactionType;
    private $classTransactionType;

    public function __construct(string $transactionType)
    {
        $this->transactionType = $transactionType;
        $this->classTransactionType = __NAMESPACE__ . "\\" . $this->cleanTransactionTypeName();
        $this->validateTransactionType();
    }

    private function cleanTransactionTypeName()
    {
        return ucfirst(strtolower(str_replace('_', '', $this->transactionType)));
    }

    private function validateTransactionType()
    {
        if (!class_exists($this->classTransactionType)) {
            throw new TransactionTypeException();
        }
    }

    public function createTransactionType(): TransactionType
    {
        return new $this->classTransactionType();
    }
}
