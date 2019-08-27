<?php

namespace spec\CommissionCalculator\Transactions\UserTypes;

use CommissionCalculator\Transactions\UserTypes\Legal;
use CommissionCalculator\Transactions\UserTypes\Natural;
use CommissionCalculator\Transactions\UserTypes\UserTypeFactory;
use CommissionCalculator\Transactions\UserTypes\UserTypeException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin UserTypeFactory
 */
class UserTypeFactorySpec extends ObjectBehavior
{
    function it_should_throw_an_exception_if_user_type_is_invalid()
    {
        $this->beConstructedWith('invalid user type');
        $this->shouldThrow(UserTypeException::class)->duringInstantiation();
    }

    function it_should_return_the_legal_user_type_object()
    {
        $this->beConstructedWith('legal');
        $this->createUserType()->shouldReturnAnInstanceOf(Legal::class);
    }

    function it_should_return_the_natural_user_type_object()
    {
        $this->beConstructedWith('natural');
        $this->createUserType()->shouldReturnAnInstanceOf(Natural::class);
    }
}
