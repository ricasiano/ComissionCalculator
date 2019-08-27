<?php
namespace CommissionCalculator\Transactions\TransactionTypes;

interface TransactionType
{
    public function getLabel();
}