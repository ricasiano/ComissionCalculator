<?php

namespace spec\CommissionCalculator\Transactions;

use CommissionCalculator\Transactions\OperationAmount;
use CommissionCalculator\Transactions\OperationDate;
use CommissionCalculator\Transactions\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin Transaction
 */
class TransactionSpec extends ObjectBehavior
{
    function it_should_return_the_week_number_for_the_year(
        UserId $userId, OperationAmount $operationAmount, OperationDate $operationDate
    )
    {
        $userId->beADoubleOf(UserId::class);
        $userId->getUserId()->willReturn(1);
        $operationAmount->beADoubleOf(OperationAmount::class);
        $operationAmount->getOperationAmount()->willReturn(100);
        $operationDate->beADoubleOf(OperationDate::class);
        $operationDate->__toString()->willReturn('2019-07-15');

        $this->beConstructedWith($userId, $operationAmount, $operationDate);

        $this->getUserId()->shouldReturn(1);
        $this->getOperationAmount()->shouldBeApproximately(100, 1.0e-9);
        $this->getWeekNumber()->shouldReturn('29');
        $this->getYear()->shouldReturn('2019');
    }
}
