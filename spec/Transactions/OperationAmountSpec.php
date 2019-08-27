<?php

namespace spec\CommissionCalculator\Transactions;

use CommissionCalculator\Transactions\OperationAmount;
use CommissionCalculator\Transactions\Exceptions\InvalidAmountException;
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
        $this->shouldThrow(InvalidAmountException::class)->duringInstantiation();
    }

    public function it_should_throw_an_exception_if_provided_with_a_negative_number()
    {
        $this->beConstructedWith(-11);
        $this->shouldThrow(InvalidAmountException::class)->duringInstantiation();
    }

    public function it_should_return_the_valid_amount()
    {
        $this->beConstructedWith('11.12');
        $this->getOperationAmount()->shouldBe(11.12);
    }
}
