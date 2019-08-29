<?php
namespace CommissionCalculator\Commissions\CashOut\NaturalPerson;

use CommissionCalculator\Transactions\Transactions;
use CommissionCalculator\Transactions\Transaction;

class AccountTransactionsFilteredByWeek
{
    private $transactions;
    private $currentTransaction;
    private $filteredTransactions;

    public function __construct(Transactions $transactions, Transaction $currentTransaction)
    {
        $this->filteredTransactions = new \SplObjectStorage();
        $transactions->rewind();
        $this->transactions = $transactions;
        $this->currentTransaction = $currentTransaction;
        $this->findByCurrentTransaction();
    }

    public function countTransactions()
    {
        return $this->filteredTransactions->count();
    }

    public function computeTotalOperationAmount()
    {
        return array_reduce(iterator_to_array($this->filteredTransactions),
            function ($total, Transaction $operationAmount) {
                $total += $operationAmount->getOperationAmount();

                return $total;
            });
    }

    private function findByCurrentTransaction()
    {
        while ($this->transactions->valid()) {
            $transaction = $this->transactions->current();

            /** @var Transaction $transaction */
            if ($this->checkIfCurrentTransactionIsSameWithRunningTransaction($transaction)) {
                $this->filteredTransactions->attach($transaction);
            }

            $this->transactions->next();
        }
    }

    private function checkIfCurrentTransactionIsSameWithRunningTransaction(Transaction $transaction)
    {
        return ($transaction->getUserId() == $this->currentTransaction->getUserId() &&
            $transaction->getWeekNumber() == $this->currentTransaction->getWeekNumber() &&
            $transaction->getYear() == $this->currentTransaction->getYear());
    }
}