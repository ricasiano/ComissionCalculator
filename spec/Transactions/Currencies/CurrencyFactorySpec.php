<?php

namespace spec\CommissionCalculator\Transactions\Currencies;

use CommissionCalculator\Transactions\Currencies\USD;
use CommissionCalculator\Transactions\Currencies\JPY;
use CommissionCalculator\Transactions\Currencies\EUR;
use CommissionCalculator\Transactions\Currencies\CurrencyFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin CurrencyFactory
 */
class CurrencyFactorySpec extends ObjectBehavior
{
    function it_should_return_an_exception_if_currency_is_not_available()
    {
        $this->beConstructedWith('NOT A VALID CURRENCY');
        $this->shouldThrow('CommissionCalculator\Transactions\Currencies\Exceptions\InvalidCurrencyException')->duringInstantiation();
    }

    function it_should_return_the_class_if_it_is_a_valid_currency()
    {
        $this->beConstructedWith('USD');
        $this->createCurrency()->shouldBeAnInstanceOf(USD::class);
    }

    function it_should_return_the_class_if_it_is_a_valid_currency_lower_cased()
    {
        $this->beConstructedWith('usd');
        $this->createCurrency()->shouldBeAnInstanceOf(USD::class);
    }

    function it_should_return_the_class_if_it_is_a_valid_currency_for_japan()
    {
        $this->beConstructedWith('Jpy');
        $this->createCurrency()->shouldBeAnInstanceOf(JPY::class);
    }

    function it_should_return_the_class_if_it_is_a_valid_currency_for_europe()
    {
        $this->beConstructedWith('eUr');
        $this->createCurrency()->shouldBeAnInstanceOf(EUR::class);
    }
}
