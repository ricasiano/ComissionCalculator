<?php

namespace spec\CommissionCalculator\Transactions\TransactionTypes;

use CommissionCalculator\Transactions\TransactionTypes\CashOut;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin CashOut
 */
class CashOutSpec extends ObjectBehavior
{
    function it_should_return_the_label_for_cash_out()
    {
        $this->getLabel()->shouldReturn('CashOut');
    }
}
