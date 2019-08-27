<?php

namespace CommissionCalculator\Transactions\TransactionTypes;

class CashIn implements TransactionType
{
    public function getLabel(): string
    {
        return 'CashIn';
    }
}
