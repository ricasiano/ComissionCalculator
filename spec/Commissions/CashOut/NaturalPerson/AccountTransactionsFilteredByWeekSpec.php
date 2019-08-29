<?php

namespace spec\CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson;

use CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson\AccountTransaction;
use CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson\AccountTransactions;
use CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson\AccountTransactionsFilteredByWeek;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin AccountTransactionsFilteredByWeek
 */
class AccountTransactionsFilteredByWeekSpec extends ObjectBehavior
{
    function it_should_return_how_many_transactions_are_performed_for_this_week(
        AccountTransaction $currentTransaction,
        AccountTransaction $validExistingTransaction,
        AccountTransaction $validExistingTransaction2,
        AccountTransaction $validExistingTransaction3,
        AccountTransaction $invalidExistingTransaction,
        AccountTransaction $invalidExistingTransaction2
    )
    {
        $accountTransactions = new AccountTransactions();

        $validExistingTransaction->beADoubleOf(AccountTransaction::class);
        $validExistingTransaction->getWeekNumber()->willReturn(1);
        $validExistingTransaction->getUserId()->willReturn(1);
        $validExistingTransaction->getYear()->willReturn(2019);
        $accountTransactions->attach($validExistingTransaction->getWrappedObject());

        $validExistingTransaction2->beADoubleOf(AccountTransaction::class);
        $validExistingTransaction2->getWeekNumber()->willReturn(1);
        $validExistingTransaction2->getUserId()->willReturn(1);
        $validExistingTransaction2->getYear()->willReturn(2019);
        $accountTransactions->attach($validExistingTransaction2->getWrappedObject());

        $validExistingTransaction3->beADoubleOf(AccountTransaction::class);
        $validExistingTransaction3->getWeekNumber()->willReturn(1);
        $validExistingTransaction3->getUserId()->willReturn(1);
        $validExistingTransaction3->getYear()->willReturn(2019);
        $accountTransactions->attach($validExistingTransaction3->getWrappedObject());

        $invalidExistingTransaction->beADoubleOf(AccountTransaction::class);
        $invalidExistingTransaction->getWeekNumber()->willReturn(2);
        $invalidExistingTransaction->getUserId()->willReturn(5);
        $invalidExistingTransaction->getYear()->willReturn(2021);
        $accountTransactions->attach($invalidExistingTransaction->getWrappedObject());

        $invalidExistingTransaction2->beADoubleOf(AccountTransaction::class);
        $invalidExistingTransaction2->getWeekNumber()->willReturn(1);
        $invalidExistingTransaction2->getUserId()->willReturn(1);
        $invalidExistingTransaction2->getYear()->willReturn(2021);
        $accountTransactions->attach($invalidExistingTransaction2->getWrappedObject());

        $currentTransaction->beADoubleOf(AccountTransaction::class);
        $currentTransaction->getWeekNumber()->willReturn(1);
        $currentTransaction->getUserId()->willReturn(1);
        $currentTransaction->getYear()->willReturn(2019);

        $this->beConstructedWith($accountTransactions, $currentTransaction);

        $this->countTransactions()->shouldBe(3);
    }

    function it_should_return_the_total_amount_of_transactions_are_performed_for_this_week(
        AccountTransaction $currentTransaction,
        AccountTransaction $validExistingTransaction,
        AccountTransaction $validExistingTransaction2,
        AccountTransaction $validExistingTransaction3,
        AccountTransaction $invalidExistingTransaction,
        AccountTransaction $invalidExistingTransaction2
    )
    {
        $accountTransactions = new AccountTransactions();

        $validExistingTransaction->beADoubleOf(AccountTransaction::class);
        $validExistingTransaction->getWeekNumber()->willReturn(1);
        $validExistingTransaction->getUserId()->willReturn(1);
        $validExistingTransaction->getYear()->willReturn(2019);
        $validExistingTransaction->getOperationAmount()->willReturn(100);
        $accountTransactions->attach($validExistingTransaction->getWrappedObject());

        $validExistingTransaction2->beADoubleOf(AccountTransaction::class);
        $validExistingTransaction2->getWeekNumber()->willReturn(1);
        $validExistingTransaction2->getUserId()->willReturn(1);
        $validExistingTransaction2->getYear()->willReturn(2019);
        $validExistingTransaction2->getOperationAmount()->willReturn(200);
        $accountTransactions->attach($validExistingTransaction2->getWrappedObject());

        $validExistingTransaction3->beADoubleOf(AccountTransaction::class);
        $validExistingTransaction3->getWeekNumber()->willReturn(1);
        $validExistingTransaction3->getUserId()->willReturn(1);
        $validExistingTransaction3->getYear()->willReturn(2019);
        $validExistingTransaction3->getOperationAmount()->willReturn(300);
        $accountTransactions->attach($validExistingTransaction3->getWrappedObject());

        $invalidExistingTransaction->beADoubleOf(AccountTransaction::class);
        $invalidExistingTransaction->getWeekNumber()->willReturn(2);
        $invalidExistingTransaction->getUserId()->willReturn(5);
        $invalidExistingTransaction->getOperationAmount()->willReturn(900);
        $invalidExistingTransaction->getYear()->willReturn(2021);

        $accountTransactions->attach($invalidExistingTransaction->getWrappedObject());

        $invalidExistingTransaction2->beADoubleOf(AccountTransaction::class);
        $invalidExistingTransaction2->getWeekNumber()->willReturn(1);
        $invalidExistingTransaction2->getUserId()->willReturn(1);
        $invalidExistingTransaction2->getYear()->willReturn(2021);
        $invalidExistingTransaction->getOperationAmount()->willReturn(1000);

        $accountTransactions->attach($invalidExistingTransaction2->getWrappedObject());

        $currentTransaction->beADoubleOf(AccountTransaction::class);
        $currentTransaction->getWeekNumber()->willReturn(1);
        $currentTransaction->getUserId()->willReturn(1);
        $currentTransaction->getYear()->willReturn(2019);

        $this->beConstructedWith($accountTransactions, $currentTransaction);

        $this->computeTotalOperationAmount()->shouldBe(600);
    }
}