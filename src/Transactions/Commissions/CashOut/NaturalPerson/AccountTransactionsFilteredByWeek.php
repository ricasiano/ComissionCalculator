<?php
namespace CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson;

class AccountTransactionsFilteredByWeek
{
    private $accountTransactions;
    private $currentTransaction;
    private $filteredTransactions;

    public function __construct(AccountTransactions $accountTransactions, AccountTransaction $currentTransaction)
    {
        $this->filteredTransactions = new \SplObjectStorage();
        $accountTransactions->rewind();
        $this->accountTransactions = $accountTransactions;
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
            function ($total, AccountTransaction $operationAmount) {
                $total += $operationAmount->getOperationAmount();

                return $total;
            });
    }

    private function findByCurrentTransaction()
    {
        while ($this->accountTransactions->valid()) {
            $accountTransaction = $this->accountTransactions->current();

            /** @var AccountTransaction $accountTransaction */
            if ($this->checkIfCurrentTransactionIsSameWithRunningTransaction($accountTransaction)) {
                $this->filteredTransactions->attach($accountTransaction);
            }

            $this->accountTransactions->next();
        }
    }

    private function checkIfCurrentTransactionIsSameWithRunningTransaction(AccountTransaction $accountTransaction)
    {
        return ($accountTransaction->getUserId() == $this->currentTransaction->getUserId() &&
            $accountTransaction->getWeekNumber() == $this->currentTransaction->getWeekNumber() &&
            $accountTransaction->getYear() == $this->currentTransaction->getYear());
    }
}