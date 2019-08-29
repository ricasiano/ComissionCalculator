<?php

namespace spec\CommissionCalculator\Commissions\CashOut\NaturalPerson;

use CommissionCalculator\Transactions\Transaction;
use CommissionCalculator\Transactions\Transactions;
use CommissionCalculator\Commissions\CashOut\NaturalPerson\TransactionsFilteredByWeek;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin TransactionsFilteredByWeek
 */
class TransactionsFilteredByWeekSpec extends ObjectBehavior
{
    function it_should_return_how_many_transactions_are_performed_for_this_week(
        Transaction $currentTransaction,
        Transaction $validExistingTransaction,
        Transaction $validExistingTransaction2,
        Transaction $validExistingTransaction3,
        Transaction $invalidExistingTransaction,
        Transaction $invalidExistingTransaction2
    )
    {
        $accountTransactions = new Transactions();

        $validExistingTransaction->beADoubleOf(Transaction::class);
        $validExistingTransaction->getWeekNumber()->willReturn(1);
        $validExistingTransaction->getUserId()->willReturn(1);
        $validExistingTransaction->getYear()->willReturn(2019);
        $accountTransactions->attach($validExistingTransaction->getWrappedObject());

        $validExistingTransaction2->beADoubleOf(Transaction::class);
        $validExistingTransaction2->getWeekNumber()->willReturn(1);
        $validExistingTransaction2->getUserId()->willReturn(1);
        $validExistingTransaction2->getYear()->willReturn(2019);
        $accountTransactions->attach($validExistingTransaction2->getWrappedObject());

        $validExistingTransaction3->beADoubleOf(Transaction::class);
        $validExistingTransaction3->getWeekNumber()->willReturn(1);
        $validExistingTransaction3->getUserId()->willReturn(1);
        $validExistingTransaction3->getYear()->willReturn(2019);
        $accountTransactions->attach($validExistingTransaction3->getWrappedObject());

        $invalidExistingTransaction->beADoubleOf(Transaction::class);
        $invalidExistingTransaction->getWeekNumber()->willReturn(2);
        $invalidExistingTransaction->getUserId()->willReturn(5);
        $invalidExistingTransaction->getYear()->willReturn(2021);
        $accountTransactions->attach($invalidExistingTransaction->getWrappedObject());

        $invalidExistingTransaction2->beADoubleOf(Transaction::class);
        $invalidExistingTransaction2->getWeekNumber()->willReturn(1);
        $invalidExistingTransaction2->getUserId()->willReturn(1);
        $invalidExistingTransaction2->getYear()->willReturn(2021);
        $accountTransactions->attach($invalidExistingTransaction2->getWrappedObject());

        $currentTransaction->beADoubleOf(Transaction::class);
        $currentTransaction->getWeekNumber()->willReturn(1);
        $currentTransaction->getUserId()->willReturn(1);
        $currentTransaction->getYear()->willReturn(2019);

        $this->beConstructedWith($accountTransactions, $currentTransaction);

        $this->countTransactions()->shouldBe(3);
    }

    function it_should_return_the_total_amount_of_transactions_are_performed_for_this_week(
        Transaction $currentTransaction,
        Transaction $validExistingTransaction,
        Transaction $validExistingTransaction2,
        Transaction $validExistingTransaction3,
        Transaction $invalidExistingTransaction,
        Transaction $invalidExistingTransaction2
    )
    {
        $accountTransactions = new Transactions();

        $validExistingTransaction->beADoubleOf(Transaction::class);
        $validExistingTransaction->getWeekNumber()->willReturn(1);
        $validExistingTransaction->getUserId()->willReturn(1);
        $validExistingTransaction->getYear()->willReturn(2019);
        $validExistingTransaction->getOperationAmount()->willReturn(100);
        $accountTransactions->attach($validExistingTransaction->getWrappedObject());

        $validExistingTransaction2->beADoubleOf(Transaction::class);
        $validExistingTransaction2->getWeekNumber()->willReturn(1);
        $validExistingTransaction2->getUserId()->willReturn(1);
        $validExistingTransaction2->getYear()->willReturn(2019);
        $validExistingTransaction2->getOperationAmount()->willReturn(200);
        $accountTransactions->attach($validExistingTransaction2->getWrappedObject());

        $validExistingTransaction3->beADoubleOf(Transaction::class);
        $validExistingTransaction3->getWeekNumber()->willReturn(1);
        $validExistingTransaction3->getUserId()->willReturn(1);
        $validExistingTransaction3->getYear()->willReturn(2019);
        $validExistingTransaction3->getOperationAmount()->willReturn(300);
        $accountTransactions->attach($validExistingTransaction3->getWrappedObject());

        $invalidExistingTransaction->beADoubleOf(Transaction::class);
        $invalidExistingTransaction->getWeekNumber()->willReturn(2);
        $invalidExistingTransaction->getUserId()->willReturn(5);
        $invalidExistingTransaction->getOperationAmount()->willReturn(900);
        $invalidExistingTransaction->getYear()->willReturn(2021);

        $accountTransactions->attach($invalidExistingTransaction->getWrappedObject());

        $invalidExistingTransaction2->beADoubleOf(Transaction::class);
        $invalidExistingTransaction2->getWeekNumber()->willReturn(1);
        $invalidExistingTransaction2->getUserId()->willReturn(1);
        $invalidExistingTransaction2->getYear()->willReturn(2021);
        $invalidExistingTransaction->getOperationAmount()->willReturn(1000);

        $accountTransactions->attach($invalidExistingTransaction2->getWrappedObject());

        $currentTransaction->beADoubleOf(Transaction::class);
        $currentTransaction->getWeekNumber()->willReturn(1);
        $currentTransaction->getUserId()->willReturn(1);
        $currentTransaction->getYear()->willReturn(2019);

        $this->beConstructedWith($accountTransactions, $currentTransaction);

        $this->computeTotalOperationAmount()->shouldBe(600);
    }
}