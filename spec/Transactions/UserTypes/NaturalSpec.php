<?php

namespace spec\CommissionCalculator\Transactions\UserTypes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NaturalSpec extends ObjectBehavior
{
    function it_should_return_the_label_for_legal()
    {
        $this->getLabel()->shouldReturn('NaturalPerson');
    }
}
