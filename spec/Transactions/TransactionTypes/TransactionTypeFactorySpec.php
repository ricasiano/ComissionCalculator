<?php

namespace spec\CommissionCalculator\Transactions\TransactionTypes;

use CommissionCalculator\Transactions\TransactionTypes\CashIn;
use CommissionCalculator\Transactions\TransactionTypes\CashOut;
use CommissionCalculator\Transactions\TransactionTypes\TransactionTypeFactory;
use CommissionCalculator\Transactions\TransactionTypes\TransactionTypeException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin TransactionTypeFactory
 */
class TransactionTypeFactorySpec extends ObjectBehavior
{
    function it_should_throw_an_exception_if_transaction_type_is_invalid()
    {
        $this->beConstructedWith('invalid user type');
        $this->shouldThrow(TransactionTypeException::class)->duringInstantiation();
    }

    function it_should_return_the_cash_in_transaction_type_object()
    {
        $this->beConstructedWith('cash_in');
        $this->createTransactionType()->shouldReturnAnInstanceOf(CashIn::class);
    }

    function it_should_return_the_cash_out_transaction_type_object()
    {
        $this->beConstructedWith('cash_out');
        $this->createTransactionType()->shouldReturnAnInstanceOf(CashOut::class);
    }
}
