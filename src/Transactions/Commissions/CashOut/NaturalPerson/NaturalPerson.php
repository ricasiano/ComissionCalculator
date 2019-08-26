<?php

namespace CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson;

use CommissionCalculator\Transactions\Commissions\AbstractCommission;

class NaturalPerson extends AbstractCommission
{
    const MAX_AMOUNT_DISCOUNTED_FOR_COMMISSION_PER_WEEK = 1000;
    const MAX_COMMISSIONED_TRANSACTIONS_PER_WEEK = 3;

    private $accountTransactionsFilteredByWeek;
    private $currentTransaction;

    public function __construct(
        AccountTransactionsFilteredByWeek $accountTransactionsFilteredByWeek,
        AccountTransaction $currentTransaction
    )
    {
        $this->accountTransactionsFilteredByWeek = $accountTransactionsFilteredByWeek;
        $this->currentTransaction = $currentTransaction;
    }

    public function computeCommission()
    {
        $operationAmount = $this->currentTransaction->getOperationAmount();
        if (self::MAX_COMMISSIONED_TRANSACTIONS_PER_WEEK <
            $this->accountTransactionsFilteredByWeek->countTransactions()) {

            return $operationAmount * self::DEFAULT_COMMISSION_RATE;
        }

        if (self::MAX_AMOUNT_DISCOUNTED_FOR_COMMISSION_PER_WEEK <
            $this->accountTransactionsFilteredByWeek->computeTotalOperationAmount()) {
            $amountForCommission = $operationAmount - self::MAX_AMOUNT_DISCOUNTED_FOR_COMMISSION_PER_WEEK;

            return  $amountForCommission * self::DEFAULT_COMMISSION_RATE;
        }

        return 0;
    }
}
