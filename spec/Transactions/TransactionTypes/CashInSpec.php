<?php

namespace spec\CommissionCalculator\Transactions\TransactionTypes;

use CommissionCalculator\Transactions\TransactionTypes\CashIn;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin CashIn
 */
class CashInSpec extends ObjectBehavior
{
    function it_should_return_the_label_for_cash_in()
    {
        $this->getLabel()->shouldReturn('CashIn');
    }
}
