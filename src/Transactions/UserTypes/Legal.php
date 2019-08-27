<?php

namespace CommissionCalculator\Transactions\UserTypes;

class Legal implements UserType
{
    public function getLabel(): string
    {
        return 'LegalPerson';
    }
}
