<?php

namespace spec\CommissionCalculator\Transactions\Commissions\CashIn;

use CommissionCalculator\Transactions\Commissions\CashIn\DefaultCommission;
use CommissionCalculator\Transactions\CurrencyConverter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DefaultCommissionSpec extends ObjectBehavior
{
    function it_should_return_the_correct_amount_if_converted_to_value_is_less_than_five_euros(
        CurrencyConverter $currencyConverter
    )
    {
        $currencyConverter->beADoubleOf(CurrencyConverter::class);
        $currencyConverter->computeConvertedAmount()->willReturn(150);

        $this->beConstructedWith($currencyConverter);

        $this->computeCommission()->shouldBeApproximately(4.5, 1.0e-9);
    }

    function it_should_return_the_correct_amount_if_converted_to_value_is_more_than_five_euros(
        CurrencyConverter $currencyConverter
    )
    {
        $currencyConverter->beADoubleOf(CurrencyConverter::class);
        $currencyConverter->computeConvertedAmount()->willReturn(1000);

        $this->beConstructedWith($currencyConverter);

        $this->computeCommission()->shouldBe(5.00);
    }
}
