<?php

namespace spec\CommissionCalculator\Transactions\Commissions\CashOut;

use CommissionCalculator\Transactions\Commissions\CashOut\LegalPerson;
use CommissionCalculator\Transactions\CurrencyConverter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin LegalPerson
 */
class LegalPersonSpec extends ObjectBehavior
{
    function it_should_return_the_correct_amount_if_converted_to_value_is_more_than_five_cents(
        CurrencyConverter $currencyConverter
    )
    {
        $currencyConverter->beADoubleOf(CurrencyConverter::class);
        $currencyConverter->computeConvertedAmount()->willReturn(150);

        $this->beConstructedWith($currencyConverter);

        $this->computeCommission()->shouldBeApproximately(4.5, 1.0e-9);
    }

    function it_should_return_5_cents_if_computed_amount_is_less_than_5_cents(
        CurrencyConverter $currencyConverter
    )
    {
        $currencyConverter->beADoubleOf(CurrencyConverter::class);
        $currencyConverter->computeConvertedAmount()->willReturn(1);

        $this->beConstructedWith($currencyConverter);

        $this->computeCommission()->shouldBe(0.05);
    }
}
