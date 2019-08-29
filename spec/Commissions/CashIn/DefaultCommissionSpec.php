<?php

namespace spec\CommissionCalculator\Transactions\Commissions\CashIn;

use CommissionCalculator\Commissions\CashIn\DefaultCommission;
use CommissionCalculator\Transactions\OperationAmount;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin DefaultCommission
 */
class DefaultCommissionSpec extends ObjectBehavior
{
    function it_should_return_the_correct_amount_if_converted_to_value_is_less_than_five_euros(
        OperationAmount $operationAmount
    )
    {
        $operationAmount->beADoubleOf(OperationAmount::class);
        $operationAmount->getOperationAmount()->willReturn(150);

        $this->beConstructedWith($operationAmount);

        $this->computeCommission()->shouldBeApproximately(.45, 1.0e-9);
    }

    function it_should_return_the_correct_amount_if_converted_to_value_is_more_than_five_euros(
        OperationAmount $operationAmount
    )
    {
        $operationAmount->beADoubleOf(OperationAmount::class);
        $operationAmount->getOperationAmount()->willReturn(1000);

        $this->beConstructedWith($operationAmount);

        $this->computeCommission()->shouldBeApproximately(3, 1.0e-9);
    }
}
