<?php

namespace spec\CommissionCalculator;

use CommissionCalculator\NumberResultFormatter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NumberResultFormatterSpec extends ObjectBehavior
{
    function it_should_return_the_format_of_the_original_JPY_currency()
    {
        $this->beConstructedWith(12345, 123.45);

        $this->formatNumber()->shouldReturn((float) 124);
    }

    function it_should_return_the_format_of_the_original_EUR_currency()
    {
        $this->beConstructedWith(123.45, 1.695);

        $this->formatNumber()->shouldReturn('1.70');
    }

    function it_should_return_the_format_that_has_zero_values_for_decimal()
    {
        $this->beConstructedWith('123.00', 1.695);

        $this->formatNumber()->shouldReturn('1.70');
    }

    function it_should_return_the_format_that_has_zero_values_for_decimal_200()
    {
        $this->beConstructedWith('200.00', 0.060);

        $this->formatNumber()->shouldReturn('0.06');
    }

    function it_should_return_the_format_that_has_zero_values_for_decimal_100()
    {
        $this->beConstructedWith('100.00', 0.30000001);

        $this->formatNumber()->shouldReturn('0.30');
    }
}
