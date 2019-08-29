<?php

namespace spec\CommissionCalculator\Commissions\CashOut\NaturalPerson;

use CommissionCalculator\Transactions\OperationAmount;
use CommissionCalculator\Transactions\Transaction;
use CommissionCalculator\Commissions\CashOut\NaturalPerson\TransactionsFilteredByWeek;
use CommissionCalculator\Commissions\CashOut\NaturalPerson\NaturalPerson;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin NaturalPerson
 */
class NaturalPersonSpec extends ObjectBehavior
{
    function it_should_not_compute_the_commission_if_the_amount_does_not_exceed_all_limits
    (
        TransactionsFilteredByWeek $accountTransactionsFilteredByWeek,
        Transaction $currentTransaction,
        OperationAmount $operationAmount
    )
    {
        $operationAmount->beADoubleOf(OperationAmount::class);
        $operationAmount->getOperationAmount()->willReturn(200);

        $accountTransactionsFilteredByWeek->beADoubleOf(TransactionsFilteredByWeek::class);
        $accountTransactionsFilteredByWeek->computeTotalOperationAmount()->willReturn(300);
        $accountTransactionsFilteredByWeek->countTransactions()->willReturn(2);

        $currentTransaction->beADoubleOf(Transaction::class);
        $currentTransaction->getOperationAmount()->willReturn($operationAmount);

        $this->beConstructedWith($accountTransactionsFilteredByWeek, $currentTransaction);

        $this->computeCommission()->shouldBe(0);
    }

    function it_should_return_the_computed_commission_if_the_total_transactions_for_the_week_exceeded
    (
        TransactionsFilteredByWeek $accountTransactionsFilteredByWeek,
        Transaction $currentTransaction,
        OperationAmount $operationAmount
    )
    {
        $operationAmount->beADoubleOf(OperationAmount::class);
        $operationAmount->getOperationAmount()->willReturn(200);

        $accountTransactionsFilteredByWeek->beADoubleOf(TransactionsFilteredByWeek::class);
        $accountTransactionsFilteredByWeek->computeTotalOperationAmount()->willReturn(300);
        $accountTransactionsFilteredByWeek->countTransactions()->willReturn(4);

        $currentTransaction->beADoubleOf(Transaction::class);
        $currentTransaction->getOperationAmount()->willReturn($operationAmount);

        $this->beConstructedWith($accountTransactionsFilteredByWeek, $currentTransaction);

        $this->computeCommission()->shouldBeApproximately(0.6, 1.0e-9);
    }

    function it_should_return_the_computed_commission_if_the_computed_transaction_amount_exceeded_for_the_week
    (
        TransactionsFilteredByWeek $accountTransactionsFilteredByWeek,
        Transaction $currentTransaction,
        OperationAmount $operationAmount
    )
    {
        $operationAmount->beADoubleOf(OperationAmount::class);
        $operationAmount->getOperationAmount()->willReturn(2000);

        $accountTransactionsFilteredByWeek->beADoubleOf(TransactionsFilteredByWeek::class);
        $accountTransactionsFilteredByWeek->computeTotalOperationAmount()->willReturn(10000);
        $accountTransactionsFilteredByWeek->countTransactions()->willReturn(3);

        $currentTransaction->beADoubleOf(Transaction::class);
        $currentTransaction->getOperationAmount()->willReturn($operationAmount);

        $this->beConstructedWith($accountTransactionsFilteredByWeek, $currentTransaction);

        $this->computeCommission()->shouldBeApproximately(6, 1.0e-9);
    }
}
