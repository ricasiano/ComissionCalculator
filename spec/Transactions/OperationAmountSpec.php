<?php

namespace spec\CommissionCalculator\Transactions;

use CommissionCalculator\Transactions\OperationAmount;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


/**
 * @mixin OperationAmount
 */
class OperationAmountSpec extends ObjectBehavior
{
    public function it_should_throw_an_exception_if_provided_with_invalid_number()
    {
        $this->beConstructedWith('not a number');
        $this->shouldThrow('CommissionCalculator\Transactions\Exceptions\InvalidAmountException')->duringInstantiation();
    }

    public function it_should_return_the_valid_amount()
    {
        $this->beConstructedWith('11.12');
        $this->getOperationAmount()->shouldBe(11.12);
    }
}
