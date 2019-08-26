<?php

namespace spec\CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson;

use CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson\AccountTransaction;
use CommissionCalculator\Transactions\CurrencyConverter;
use CommissionCalculator\Transactions\OperationAmount;
use CommissionCalculator\Transactions\OperationDate;
use CommissionCalculator\Transactions\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin AccountTransaction
 */
class AccountTransactionSpec extends ObjectBehavior
{
    function it_should_return_the_week_number_for_the_year(
        UserId $userId, CurrencyConverter $operationAmount, OperationDate $operationDate
    )
    {
        $userId->beADoubleOf(UserId::class);
        $userId->getUserId()->willReturn(1);
        $operationAmount->beADoubleOf(CurrencyConverter::class);
        $operationAmount->computeConvertedAmount()->willReturn(100);
        $operationDate->beADoubleOf(OperationDate::class);
        $operationDate->__toString()->willReturn('2019-07-15');

        $this->beConstructedWith($userId, $operationAmount, $operationDate);

        $this->getUserId()->shouldReturn(1);
        $this->getOperationAmount()->shouldReturn(100);
        $this->getWeekNumber()->shouldReturn('29');
        $this->getYear()->shouldReturn('2019');
    }
}
