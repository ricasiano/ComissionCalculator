<?php

namespace spec\CommissionCalculator\Commissions;

use CommissionCalculator\Commissions\CashIn\DefaultCommission;
use CommissionCalculator\Commissions\CashOut\LegalPerson;
use CommissionCalculator\Commissions\CashOut\NaturalPerson\NaturalPerson;
use CommissionCalculator\Commissions\CommissionFactory;
use CommissionCalculator\Transactions\OperationDate;
use CommissionCalculator\Transactions\Transactions;
use CommissionCalculator\Transactions\Transaction;
use CommissionCalculator\Transactions\TransactionTypes\CashIn;
use CommissionCalculator\Transactions\TransactionTypes\CashOut;
use CommissionCalculator\Transactions\UserId;
use CommissionCalculator\Transactions\UserTypes\Legal;
use CommissionCalculator\Transactions\OperationAmount;
use CommissionCalculator\Transactions\UserTypes\Natural;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin CommissionFactory
 */
class CommissionFactorySpec extends ObjectBehavior
{
    function it_should_return_the_default_commission_calculator_for_cash_in_for_legal_person_type(
        Transactions $transactions,
        Transaction $transaction,
        CashIn $transactionType,
        Legal $userType,
        OperationAmount $operationAmount
    )
    {
        $transactionType->beADoubleOf(CashIn::class);

        $userType->beADoubleOf(Legal::class);

        $operationAmount->beADoubleOf(OperationAmount::class);
        $operationAmount->getOperationAmount()->willReturn(100);

        $transaction->beADoubleOf(Transaction::class);
        $transaction->getUserType()->willReturn($userType);
        $transaction->getTransactionType()->willReturn($transactionType);
        $transaction->getOperationAmount()->willReturn($operationAmount);

        $transactions->beADoubleOf(Transactions::class);
        $transactions->current()->willReturn($transaction);

        $this->beConstructedWith($transactions);
        $this->createCommission()->shouldBeAnInstanceOf(DefaultCommission::class);
    }

    function it_should_return_the_default_commission_calculator_for_cash_in_for_natural_person_type(
        Transactions $transactions,
        Transaction $transaction,
        CashIn $transactionType,
        Natural $userType,
        OperationAmount $operationAmount
    )
    {
        $transactionType->beADoubleOf(CashIn::class);

        $userType->beADoubleOf(Natural::class);

        $operationAmount->beADoubleOf(OperationAmount::class);
        $operationAmount->getOperationAmount()->willReturn(100);

        $transaction->beADoubleOf(Transaction::class);
        $transaction->getUserType()->willReturn($userType);
        $transaction->getTransactionType()->willReturn($transactionType);
        $transaction->getOperationAmount()->willReturn($operationAmount);

        $transactions->beADoubleOf(Transactions::class);
        $transactions->current()->willReturn($transaction);

        $this->beConstructedWith($transactions);
        $this->createCommission()->shouldBeAnInstanceOf(DefaultCommission::class);
    }

    function it_should_return_the_default_commission_calculator_for_cash_out_for_legal_person_type(
        Transactions $transactions,
        Transaction $transaction,
        CashOut $transactionType,
        Legal $userType,
        OperationAmount $operationAmount
    )
    {
        $transactionType->beADoubleOf(CashOut::class);

        $userType->beADoubleOf(Legal::class);

        $operationAmount->beADoubleOf(OperationAmount::class);
        $operationAmount->getOperationAmount()->willReturn(100);

        $transaction->beADoubleOf(Transaction::class);
        $transaction->getUserType()->willReturn($userType);
        $transaction->getTransactionType()->willReturn($transactionType);
        $transaction->getOperationAmount()->willReturn($operationAmount);

        $transactions->beADoubleOf(Transactions::class);
        $transactions->current()->willReturn($transaction);

        $this->beConstructedWith($transactions);
        $this->createCommission()->shouldBeAnInstanceOf(LegalPerson::class);
    }

    function it_should_return_the_default_commission_calculator_for_cash_out_for_natural_person_type(
        Transactions $transactions,
        Transaction $transaction,
        CashOut $transactionType,
        Natural $userType,
        OperationAmount $operationAmount,
        UserId $userId,
        OperationDate $operationDate
    )
    {
        $transactionType->beADoubleOf(CashOut::class);

        $userType->beADoubleOf(Natural::class);

        $operationDate->beADoubleOf(OperationDate::class);
        $operationDate->getWeekNumber()->willReturn(1);
        $operationDate->getYear()->willReturn(2019);

        $userId->beADoubleOf(UserId::class);
        $userId->getUserId()->willReturn(1);

        $operationAmount->beADoubleOf(OperationAmount::class);
        $operationAmount->getOperationAmount()->willReturn(100);

        $transaction->beADoubleOf(Transaction::class);
        $transaction->getUserType()->willReturn($userType);
        $transaction->getTransactionType()->willReturn($transactionType);
        $transaction->getOperationAmount()->willReturn($operationAmount);
        $transaction->getUserId()->willReturn($userId);
        $transaction->getOperationDate()->willReturn($operationDate);


        $transactions->beADoubleOf(Transactions::class);
        $transactions->current()->willReturn($transaction);
        $transactions->rewind()->willReturn(null);
        $transactions->valid()->willReturn(false);


        $this->beConstructedWith($transactions);
        $this->createCommission()->shouldBeAnInstanceOf(NaturalPerson::class);
    }
}
