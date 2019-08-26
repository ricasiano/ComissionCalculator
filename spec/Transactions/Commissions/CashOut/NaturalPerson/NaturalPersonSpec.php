<?php

namespace spec\CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson;

use CommissionCalculator\Transactions\Commissions\CashOut\NaturalPerson\NaturalPerson;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NaturalPersonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(NaturalPerson::class);
    }
}
