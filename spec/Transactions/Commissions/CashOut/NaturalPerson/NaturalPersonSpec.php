<?php

namespace spec\CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson;

use CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson\AccountTransaction;
use CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson\AccountTransactionsFilteredByWeek;
use CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson\NaturalPerson;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin NaturalPerson
 */
class NaturalPersonSpec extends ObjectBehavior
{
    function it_should_not_compute_the_commission_if_the_amount_does_not_exceed_all_limits
    (
        AccountTransactionsFilteredByWeek $accountTransactionsFilteredByWeek,
        AccountTransaction $currentTransaction
    )
    {
        $accountTransactionsFilteredByWeek->beADoubleOf(AccountTransactionsFilteredByWeek::class);
        $accountTransactionsFilteredByWeek->computeTotalOperationAmount()->willReturn(300);
        $accountTransactionsFilteredByWeek->countTransactions()->willReturn(2);

        $currentTransaction->beADoubleOf(AccountTransaction::class);
        $currentTransaction->getOperationAmount()->willReturn(200);

        $this->beConstructedWith($accountTransactionsFilteredByWeek, $currentTransaction);

        $this->computeCommission()->shouldBe(0);
    }

    function it_should_return_the_computed_commission_if_the_total_transactions_for_the_week_exceeded
    (
        AccountTransactionsFilteredByWeek $accountTransactionsFilteredByWeek,
        AccountTransaction $currentTransaction
    )
    {
        $accountTransactionsFilteredByWeek->beADoubleOf(AccountTransactionsFilteredByWeek::class);
        $accountTransactionsFilteredByWeek->computeTotalOperationAmount()->willReturn(300);
        $accountTransactionsFilteredByWeek->countTransactions()->willReturn(4);

        $currentTransaction->beADoubleOf(AccountTransaction::class);
        $currentTransaction->getOperationAmount()->willReturn(200);

        $this->beConstructedWith($accountTransactionsFilteredByWeek, $currentTransaction);

        $this->computeCommission()->shouldBeApproximately(0.6, 1.0e-9);
    }

    function it_should_return_the_computed_commission_if_the_computed_transaction_amount_exceeded_for_the_week
    (
        AccountTransactionsFilteredByWeek $accountTransactionsFilteredByWeek,
        AccountTransaction $currentTransaction
    )
    {
        $accountTransactionsFilteredByWeek->beADoubleOf(AccountTransactionsFilteredByWeek::class);
        $accountTransactionsFilteredByWeek->computeTotalOperationAmount()->willReturn(10000);
        $accountTransactionsFilteredByWeek->countTransactions()->willReturn(3);

        $currentTransaction->beADoubleOf(AccountTransaction::class);
        $currentTransaction->getOperationAmount()->willReturn(2000);

        $this->beConstructedWith($accountTransactionsFilteredByWeek, $currentTransaction);

        $this->computeCommission()->shouldBeApproximately(3, 1.0e-9);
    }
}
