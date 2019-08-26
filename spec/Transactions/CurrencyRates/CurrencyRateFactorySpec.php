<?php

namespace spec\CommissionCalculator\Transactions\CurrencyRates;

use CommissionCalculator\Transactions\CurrencyRates\JPY\EUR;
use CommissionCalculator\Transactions\CurrencyRates\CurrencyRateFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin CurrencyRateFactory
 */
class CurrencyRateFactorySpec extends ObjectBehavior
{
    function it_should_return_the_valid_currency_rate_from_JPY_to_EUR()
    {
        $this->beConstructedWith('jpy', 'eur');
        $this->createCurrencyRate()->shouldBeAnInstanceOf(EUR::class);
    }
}
