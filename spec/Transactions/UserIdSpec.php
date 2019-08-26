<?php

namespace spec\CommissionCalculator\Transactions;

use CommissionCalculator\Transactions\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin UserId
 */
class UserIdSpec extends ObjectBehavior
{
    function it_should_throw_an_error_if_it_is_not_a_valid_number()
    {
        $this->beConstructedWith('not a number');
        $this->shouldThrow('CommissionCalculator\Transactions\Exceptions\InvalidUserIdException')->duringInstantiation();
    }

    function it_should_throw_an_error_if_it_is_not_a_valid_integer()
    {
        $this->beConstructedWith(11.12);
        $this->shouldThrow('CommissionCalculator\Transactions\Exceptions\InvalidUserIdException')->duringInstantiation();
    }

    function it_should_return_the_id_if_valid()
    {
        $this->beConstructedWith('123');
        $this->getUserId()->shouldBe(123);
    }

    function it_should_return_the_id_if_valid_and_in_integer_format()
    {
        $this->beConstructedWith(123);
        $this->getUserId()->shouldBe(123);
    }
}
