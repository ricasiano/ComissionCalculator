<?php

namespace spec\CommissionCalculator\Transactions;

use CommissionCalculator\Transactions\CurrencyConverter;
use CommissionCalculator\Transactions\CurrencyRates\JPY\EUR;
use CommissionCalculator\Transactions\CurrencyRates\CurrencyRate;
use CommissionCalculator\Transactions\OperationAmount;
use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin CurrencyConverter
 */
class CurrencyConverterSpec extends ObjectBehavior
{
    public function it_should_return_the_correct_converted_amount_from_JPY_to_EUR(
        CurrencyRate $currencyRate,
        OperationAmount $operationAmount
    )
    {
        $currencyRate->beADoubleOf(EUR::class);
        $currencyRate->getConversionRate()->willReturn(0.0078);


        $this->beConstructedWith($currencyRate, 100);

        $this->computeConvertedAmount()
            ->shouldBeApproximately(0.78, 1.0e-9);
    }

    public function it_should_return_the_correct_converted_amount_from_EUR_to_JPY(
        CurrencyRate $currencyRate,
        OperationAmount $operationAmount
    )
    {
        $currencyRate->beADoubleOf(EUR::class);
        $currencyRate->getConversionRate()->willReturn(129.53);

        $this->beConstructedWith($currencyRate, 100);

        $this->computeConvertedAmount()
            ->shouldBeApproximately(12953, 1.0e-9);
    }
}
