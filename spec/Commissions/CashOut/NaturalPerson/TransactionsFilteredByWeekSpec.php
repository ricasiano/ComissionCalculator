<?php

namespace spec\CommissionCalculator\Commissions\CashOut\NaturalPerson;

use CommissionCalculator\Transactions\Transaction;
use CommissionCalculator\Transactions\Transactions;
use CommissionCalculator\Commissions\CashOut\NaturalPerson\TransactionsFilteredByWeek;
use CommissionCalculator\Transactions\UserId;
use CommissionCalculator\Transactions\OperationAmount;
use CommissionCalculator\Transactions\OperationDate;
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
        Transaction $invalidExistingTransaction2,
        UserId $userId,
        UserId $userId2,
        OperationDate $operationDate_1_2019,
        OperationDate $operationDate_2_2021,
        OperationDate $operationDate_1_2021
    )
    {
        $accountTransactions = new Transactions();

        $userId->beADoubleOf(UserId::class);
        $userId->getUserId()->willReturn(1);

        $userId2->beADoubleOf(UserId::class);
        $userId2->getUserId()->willReturn(5);

        $operationDate_1_2019->beADoubleOf(OperationDate::class);
        $operationDate_1_2019->getWeekNumber()->willReturn(1);
        $operationDate_1_2019->getYear()->willReturn(2019);

        $operationDate_2_2021->beADoubleOf(OperationDate::class);
        $operationDate_2_2021->getWeekNumber()->willReturn(2);
        $operationDate_2_2021->getYear()->willReturn(2021);

        $operationDate_1_2021->beADoubleOf(OperationDate::class);
        $operationDate_1_2021->getWeekNumber()->willReturn(1);
        $operationDate_1_2021->getYear()->willReturn(2021);

        $validExistingTransaction->beADoubleOf(Transaction::class);
        $validExistingTransaction->getUserId()->willReturn($userId);
        $validExistingTransaction->getOperationDate()->willReturn($operationDate_1_2019);
        $accountTransactions->attach($validExistingTransaction->getWrappedObject());

        $validExistingTransaction2->beADoubleOf(Transaction::class);
        $validExistingTransaction2->getUserId()->willReturn($userId);
        $validExistingTransaction2->getOperationDate()->willReturn($operationDate_1_2019);
        $accountTransactions->attach($validExistingTransaction2->getWrappedObject());

        $validExistingTransaction3->beADoubleOf(Transaction::class);
        $validExistingTransaction3->getUserId()->willReturn($userId);
        $validExistingTransaction3->getOperationDate()->willReturn($operationDate_1_2019);
        $accountTransactions->attach($validExistingTransaction3->getWrappedObject());

        $invalidExistingTransaction->beADoubleOf(Transaction::class);
        $invalidExistingTransaction->getUserId()->willReturn($userId2);
        $invalidExistingTransaction->getOperationDate()->willReturn($operationDate_2_2021);
        $accountTransactions->attach($invalidExistingTransaction->getWrappedObject());

        $invalidExistingTransaction2->beADoubleOf(Transaction::class);
        $invalidExistingTransaction2->getUserId()->willReturn($userId);
        $invalidExistingTransaction2->getOperationDate()->willReturn($operationDate_1_2021);
        $accountTransactions->attach($invalidExistingTransaction2->getWrappedObject());

        $currentTransaction->beADoubleOf(Transaction::class);
        $currentTransaction->getUserId()->willReturn($userId);
        $currentTransaction->getOperationDate()->willReturn($operationDate_1_2019);

        $this->beConstructedWith($accountTransactions, $currentTransaction);

        $this->countTransactions()->shouldBe(4);
    }

    function it_should_return_the_total_amount_of_transactions_are_performed_for_this_week(
        Transaction $currentTransaction,
        Transaction $validExistingTransaction,
        Transaction $validExistingTransaction2,
        Transaction $validExistingTransaction3,
        Transaction $invalidExistingTransaction,
        Transaction $invalidExistingTransaction2,
        UserId $userId,
        UserId $userId2,
        OperationAmount $operationAmount100,
        OperationAmount $operationAmount200,
        OperationAmount $operationAmount300,
        OperationAmount $operationAmount900,
        OperationAmount $operationAmount1000,
        OperationDate $operationDate_1_2019,
        OperationDate $operationDate_2_2021,
        OperationDate $operationDate_1_2021
    )
    {
        $accountTransactions = new Transactions();

        $userId->beADoubleOf(UserId::class);
        $userId->getUserId()->willReturn(1);

        $userId2->beADoubleOf(UserId::class);
        $userId2->getUserId()->willReturn(5);

        $operationDate_1_2019->beADoubleOf(OperationDate::class);
        $operationDate_1_2019->getWeekNumber()->willReturn(1);
        $operationDate_1_2019->getYear()->willReturn(2019);

        $operationDate_2_2021->beADoubleOf(OperationDate::class);
        $operationDate_2_2021->getWeekNumber()->willReturn(2);
        $operationDate_2_2021->getYear()->willReturn(2021);

        $operationDate_1_2021->beADoubleOf(OperationDate::class);
        $operationDate_1_2021->getWeekNumber()->willReturn(1);
        $operationDate_1_2021->getYear()->willReturn(2021);

        $operationAmount100->beADoubleOf(OperationAmount::class);
        $operationAmount100->getOperationAmount()->willReturn(100);

        $operationAmount200->beADoubleOf(OperationAmount::class);
        $operationAmount200->getOperationAmount()->willReturn(200);

        $operationAmount300->beADoubleOf(OperationAmount::class);
        $operationAmount300->getOperationAmount()->willReturn(300);

        $operationAmount900->beADoubleOf(OperationAmount::class);
        $operationAmount900->getOperationAmount()->willReturn(900);

        $operationAmount1000->beADoubleOf(OperationAmount::class);
        $operationAmount1000->getOperationAmount()->willReturn(1000);

        $validExistingTransaction->beADoubleOf(Transaction::class);
        $validExistingTransaction->getUserId()->willReturn($userId);
        $validExistingTransaction->getOperationDate()->willReturn($operationDate_1_2019);
        $validExistingTransaction->getOperationAmount()->willReturn($operationAmount100);
        $accountTransactions->attach($validExistingTransaction->getWrappedObject());

        $validExistingTransaction2->beADoubleOf(Transaction::class);
        $validExistingTransaction2->getUserId()->willReturn($userId);
        $validExistingTransaction2->getOperationDate()->willReturn($operationDate_1_2019);
        $validExistingTransaction2->getOperationAmount()->willReturn($operationAmount200);
        $accountTransactions->attach($validExistingTransaction2->getWrappedObject());

        $validExistingTransaction3->beADoubleOf(Transaction::class);
        $validExistingTransaction3->getUserId()->willReturn($userId);
        $validExistingTransaction3->getOperationDate()->willReturn($operationDate_1_2019);
        $validExistingTransaction3->getOperationAmount()->willReturn($operationAmount300);
        $accountTransactions->attach($validExistingTransaction3->getWrappedObject());

        $invalidExistingTransaction->beADoubleOf(Transaction::class);
        $invalidExistingTransaction->getUserId()->willReturn($userId2);
        $invalidExistingTransaction->getOperationAmount()->willReturn($operationAmount900);
        $invalidExistingTransaction->getOperationDate()->willReturn($operationDate_2_2021);

        $accountTransactions->attach($invalidExistingTransaction->getWrappedObject());

        $invalidExistingTransaction2->beADoubleOf(Transaction::class);
        $invalidExistingTransaction2->getUserId()->willReturn($userId);
        $invalidExistingTransaction2->getOperationDate()->willReturn($operationDate_1_2021);
        $invalidExistingTransaction2->getOperationAmount()->willReturn($operationAmount1000);

        $accountTransactions->attach($invalidExistingTransaction2->getWrappedObject());

        $currentTransaction->beADoubleOf(Transaction::class);
        $currentTransaction->getUserId()->willReturn($userId);
        $currentTransaction->getOperationDate()->willReturn($operationDate_1_2019);

        $this->beConstructedWith($accountTransactions, $currentTransaction);

        $this->computeTotalOperationAmount()->shouldBeApproximately(1600, 1.0e-9);;
    }
}