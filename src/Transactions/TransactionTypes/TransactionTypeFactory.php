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
        $transactionType = array_map('ucfirst', explode('_', $this->transactionType));

        return implode('', $transactionType);
    }

    private function validateTransactionType()
    {
        if (!class_exists($this->classTransactionType)) {
            throw new TransactionTypeException();
        }
    }

    public function createTransactionType(): TransactionType
    {
        $transactionType = new $this->classTransactionType();

        return $transactionType;
    }
}
