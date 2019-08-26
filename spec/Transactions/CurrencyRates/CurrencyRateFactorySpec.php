<?php

namespace spec\CommissionCalculator\Transactions\CurrencyRates;

use CommissionCalculator\Transactions\CurrencyRates\JPY\EUR;
use CommissionCalculator\Transactions\CurrencyRates\EUR\JPY;
use CommissionCalculator\Transactions\CurrencyRates\CurrencyRateFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin CurrencyRateFactory
 */
class CurrencyRateFactorySpec extends ObjectBehavior
{
    function it_should_return_an_exception_if_currency_rate_is_not_found()
    {
        $this->beConstructedWith('not found', 'not found');
    }

    function it_should_return_the_valid_currency_rate_from_JPY_to_EUR()
    {
        $this->beConstructedWith('jpy', 'eur');
        $this->createCurrencyRate()->shouldBeAnInstanceOf(EUR::class);
    }

    function it_should_return_the_valid_currency_rate_from_EUR_to_JPY()
    {
        $this->beConstructedWith('eur', 'jpy');
        $this->createCurrencyRate()->shouldBeAnInstanceOf(JPY::class);
    }
}