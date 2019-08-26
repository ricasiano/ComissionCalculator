<?php
namespace CommissionCalculator\Transactions\Commissions;

interface Commission
{
    public function computeCommission();
}