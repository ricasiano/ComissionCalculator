<?php
namespace CommissionCalculator\Commissions\CashOut\NaturalPerson;

use CommissionCalculator\Transactions\Transactions;
use CommissionCalculator\Transactions\Transaction;

class TransactionsFilteredByWeek
{
    private $transactions;
    /** @var Transaction $currentTransaction */
    private $currentTransaction;
    private $filteredTransactions;

    public function __construct(Transactions $transactions, Transaction $transaction)
    {
        $this->filteredTransactions = new \SplObjectStorage();
        $this->currentTransaction = $transaction;
        $this->operationDate = $this->currentTransaction->getOperationDate();
        $transactions->rewind();
        $this->transactions = $transactions;
        $this->findByCurrentTransaction();
    }

    public function countTransactions()
    {
        return $this->filteredTransactions->count();
    }

    public function computeTotalOperationAmount()
    {
        return array_reduce(iterator_to_array($this->filteredTransactions),
            function ($total, Transaction $transaction) {
                $operationAmount = $transaction->getOperationAmount();
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
        $transactionUserId = $transaction->getUserId();
        $currentTransactionUserId = $this->currentTransaction->getUserId();
        $operationDate = $transaction->getOperationDate();

        return ($transactionUserId->getUserId() == $currentTransactionUserId->getUserId() &&
            $operationDate->getWeekNumber() == $this->operationDate->getWeekNumber());
    }
}