<?php

namespace CommissionCalculator\Commissions;

use CommissionCalculator\Commissions\CashIn\DefaultCommission;
use CommissionCalculator\Commissions\CashOut\LegalPerson;
use CommissionCalculator\Commissions\CashOut\NaturalPerson\NaturalPerson;
use CommissionCalculator\Commissions\CashOut\NaturalPerson\TransactionsFilteredByWeek;
use CommissionCalculator\Transactions\Transaction;
use CommissionCalculator\Transactions\Transactions;
use CommissionCalculator\Transactions\TransactionTypes\TransactionType;
use CommissionCalculator\Transactions\UserTypes\Legal;
use CommissionCalculator\Transactions\UserTypes\Natural;
use CommissionCalculator\Transactions\UserTypes\UserType;
use CommissionCalculator\Transactions\TransactionTypes\CashIn;
use CommissionCalculator\Transactions\TransactionTypes\CashOut;

class CommissionFactory
{
    /** @var Transaction transaction */
    private $transaction;
    /** @var TransactionType $transactionType */
    private $transactionType;
    /** @var UserType $userType */
    private $userType;
    private $transactions;

    public function __construct(Transactions $transactions)
    {
        $this->transactions = $transactions;
        $this->transaction = $transactions->current();
        $this->transactionType = $this->transaction->getTransactionType();
        $this->userType = $this->transaction->getUserType();
    }

    public function createCommission(): Commission
    {
        if ($this->transactionType instanceof CashIn) {
            return new DefaultCommission($this->transaction->getOperationAmount());
        }

        if ($this->transactionType instanceof CashOut && $this->userType instanceof Legal) {
            return new LegalPerson($this->transaction->getOperationAmount());
        }

        if ($this->transactionType instanceof CashOut && $this->userType instanceof Natural) {
            return $this->buildNaturalPersonCommission();
        }

        throw new InvalidCommissionException();
    }

    private function buildNaturalPersonCommission(): NaturalPerson
    {

        $transactionsFilteredByWeek = new TransactionsFilteredByWeek(
            $this->transactions,
            $this->transaction
        );

        return new NaturalPerson($transactionsFilteredByWeek, $this->transaction);
    }
}
