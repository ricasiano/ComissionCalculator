<?php

namespace spec\CommissionCalculator\Transactions;

use CommissionCalculator\Transactions\OperationDate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin OperationDate
 */
class OperationDateSpec extends ObjectBehavior
{
    function it_should_return_an_exception_if_it_is_not_using_a_properly_formatted_date()
    {
        $this->beConstructedWith('not properly formatted date');
        $this->shouldThrow('CommissionCalculator\Transactions\Exceptions\InvalidDateException')->duringInstantiation();
    }

    function it_should_return_an_exception_if_it_is_properly_formatted_but_has_invalid_day()
    {
        $this->beConstructedWith('2019-01-99');
        $this->shouldThrow('CommissionCalculator\Transactions\Exceptions\InvalidDateException')->duringInstantiation();
    }

    function it_should_return_an_exception_if_it_is_earlier_than_the_valid_start_date()
    {
        $this->beConstructedWith('1800-01-01');
        $this->shouldThrow('CommissionCalculator\Transactions\Exceptions\InvalidDateException')->duringInstantiation();
    }

    function it_should_return_an_exception_if_it_is_later_than_the_provided_end_date()
    {
        $this->beConstructedWith('2800-01-01');
        $this->shouldThrow('CommissionCalculator\Transactions\Exceptions\InvalidDateException')->duringInstantiation();
    }

    function it_should_return_the_date_if_it_is_valid()
    {
        $this->beConstructedWith('2019-01-01');
        $this->__toString()->shouldBe('2019-01-01');
    }
}
