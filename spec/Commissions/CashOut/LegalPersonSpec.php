<?php

namespace spec\CommissionCalculator\Transactions\Commissions\CashOut;

use CommissionCalculator\Transactions\Commissions\CashOut\LegalPerson;
use CommissionCalculator\Transactions\OperationAmount;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin LegalPerson
 */
class LegalPersonSpec extends ObjectBehavior
{
    function it_should_return_the_correct_amount_if_converted_to_value_is_more_than_five_cents(
        OperationAmount $operationAmount
    )
    {
        $operationAmount->beADoubleOf(OperationAmount::class);
        $operationAmount->getOperationAmount()->willReturn(150);

        $this->beConstructedWith($operationAmount);

        $this->computeCommission()->shouldBeApproximately(0.5, 1.0e-9);
    }

    function it_should_return_5_cents_if_computed_amount_is_less_than_5_cents(
        OperationAmount $operationAmount
    )
    {
        $operationAmount->beADoubleOf(OperationAmount::class);
        $operationAmount->getOperationAmount()->willReturn(1);

        $this->beConstructedWith($operationAmount);

        $this->computeCommission()->shouldBe(0.5);
    }
}
