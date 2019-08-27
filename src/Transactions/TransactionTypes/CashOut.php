<?php

namespace CommissionCalculator\Transactions\TransactionTypes;

class CashOut implements TransactionType
{
    public function getLabel(): string
    {
        return 'CashOut';
    }
}
