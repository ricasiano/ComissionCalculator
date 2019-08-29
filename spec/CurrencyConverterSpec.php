<?php
namespace spec\CommissionCalculator;

use CommissionCalculator\CurrencyConverter;
use CommissionCalculator\CurrencyRates\JPY\EUR;
use CommissionCalculator\CurrencyRates\CurrencyRate;
use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin CurrencyConverter
 */
class CurrencyConverterSpec extends ObjectBehavior
{
    public function it_should_return_the_correct_converted_amount_from_JPY_to_EUR(
        CurrencyRate $currencyRate
    )
    {
        $currencyRate->beADoubleOf(EUR::class);
        $currencyRate->getConversionRate()->willReturn(0.0078);


        $this->beConstructedWith($currencyRate, 100);

        $this->computeConvertedAmount()
            ->shouldBeApproximately(0.78, 1.0e-9);
    }

    public function it_should_return_the_correct_converted_amount_from_EUR_to_JPY(
        CurrencyRate $currencyRate
    )
    {
        $currencyRate->beADoubleOf(EUR::class);
        $currencyRate->getConversionRate()->willReturn(129.53);

        $this->beConstructedWith($currencyRate, 100);

        $this->computeConvertedAmount()
            ->shouldBeApproximately(12953, 1.0e-9);
    }

    public function it_should_return_the_correct_converted_amount_from_JPY_to_EUR_with_ceil_on_3_decimal_places(
        CurrencyRate $currencyRate
    )
    {
        $currencyRate->beADoubleOf(EUR::class);
        $currencyRate->getConversionRate()->willReturn(0.007814232);


        $this->beConstructedWith($currencyRate, 100);

        $this->computeConvertedAmount()
            ->shouldBeApproximately(0.7814232, 1.0e-9);
    }
}
