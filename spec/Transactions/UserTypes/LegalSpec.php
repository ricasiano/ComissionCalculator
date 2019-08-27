<?php

namespace spec\CommissionCalculator\Transactions\UserTypes;

use CommissionCalculator\Transactions\UserTypes\Legal;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin Legal
 */
class LegalSpec extends ObjectBehavior
{
    function it_should_return_the_label_for_legal()
    {
        $this->getLabel()->shouldReturn('LegalPerson');
    }
}
