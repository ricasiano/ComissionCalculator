<?php

namespace CommissionCalculator\Transactions\UserTypes;

class Legal implements UserType
{
    public function getLabel()
    {
        return 'LegalPerson';
    }
}
