<?php

namespace CommissionCalculator\Commissions;

use CommissionCalculator\Commissions\CashIn\DefaultCommission;
use CommissionCalculator\Commissions\CashOut\LegalPerson;
use CommissionCalculator\Commissions\CashOut\NaturalPerson\AccountTransactions;
use CommissionCalculator\Commissions\CashOut\NaturalPerson\NaturalPerson;
use CommissionCalculator\TransactionTypes\CashIn;
use CommissionCalculator\TransactionTypes\TransactionType;
use CommissionCalculator\UserTypes\UserType;

class CommissionFactory
{
    private $transactionType;
    private $userType;

    public function __construct(TransactionType $transactionType, UserType $userType)
    {
        $this->transactionType = $transactionType;
        $this->userType = $userType;
    }

    public function createCommission()
    {
        switch ($this->transactionType->getLabel()) {
            case 'CashIn':
                return new DefaultCommission();
                break;

            case 'CashOut':
                return $this->buildCashOutCommission();
                break;

            default:
                throw new InvalidCommissionException();
        }
    }

    private function buildCashOutCommission()
    {
        switch ($this->userType->getLabel()) {
            case 'LegalPerson':
                return new LegalPerson();
                break;

            case 'NaturalPerson':
                AccountTransactions::attachTransaction();
                return new NaturalPerson();
                break;

            default:
                throw new InvalidCommissionException();
        }
    }
}
