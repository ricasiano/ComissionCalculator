<?php

namespace CommissionCalculator\Commissions\CashOut\NaturalPerson;

use CommissionCalculator\Commissions\AbstractCommission;
use CommissionCalculator\Transactions\Transaction;

class NaturalPerson extends AbstractCommission
{
    const MAX_AMOUNT_DISCOUNTED_FOR_COMMISSION_PER_WEEK = 1000;
    const MAX_COMMISSIONED_TRANSACTIONS_PER_WEEK = 3;

    private $accountTransactionsFilteredByWeek;
    private $totalTransactionsForWeek;
    private $currentTransactionAmount;

    public function __construct(
        TransactionsFilteredByWeek $accountTransactionsFilteredByWeek,
        Transaction $currentTransaction
    )
    {
        $this->accountTransactionsFilteredByWeek = $accountTransactionsFilteredByWeek;
        $this->totalTransactionsForWeek = $accountTransactionsFilteredByWeek->computeTotalOperationAmount();
        $this->currentTransactionAmount = $currentTransaction->getOperationAmount()->getOperationAmount();
    }

    public function computeCommission()
    {
        if (self::MAX_COMMISSIONED_TRANSACTIONS_PER_WEEK <
            $this->accountTransactionsFilteredByWeek->countTransactions()) {
            return $this->currentTransactionAmount * self::DEFAULT_COMMISSION_RATE;
        }

        if (self::MAX_AMOUNT_DISCOUNTED_FOR_COMMISSION_PER_WEEK < $this->totalTransactionsForWeek) {
            return $this->computeExcessAmountForTheWeek() * self::DEFAULT_COMMISSION_RATE;
        }

        return 0;
    }

    private function computeExcessAmountForTheWeek() {
        if ($this->totalTransactionsForWeek <
            $this->currentTransactionAmount + self::MAX_AMOUNT_DISCOUNTED_FOR_COMMISSION_PER_WEEK) {

            return $this->totalTransactionsForWeek - self::MAX_AMOUNT_DISCOUNTED_FOR_COMMISSION_PER_WEEK;
        }

        return $this->currentTransactionAmount;
    }

}
