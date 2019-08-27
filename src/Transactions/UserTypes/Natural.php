<?php

namespace CommissionCalculator\Transactions\UserTypes;

class Natural implements UserType
{
    public function getLabel(): string
    {
        return 'NaturalPerson';
    }
}
