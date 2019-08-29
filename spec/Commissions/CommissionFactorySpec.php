<?php

namespace spec\CommissionCalculator\Transactions\Commissions;

use CommissionCalculator\Commissions\CashIn\DefaultCommission;
use CommissionCalculator\Commissions\CommissionFactory;
use CommissionCalculator\Transactions\TransactionTypes\CashIn;
use CommissionCalculator\Transactions\UserTypes\Legal;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin CommissionFactory
 */
class CommissionFactorySpec extends ObjectBehavior
{
    function it_should_return_the_default_commission_calculator_for_cash_in_for_legal_person_type()
    {
        $this->beConstructedWith(new CashIn(), new Legal());
        $this->createCommission()->shouldReturnInstanceOf(DefaultCommission::class);
    }
}
