<?php
namespace CommissionCalculator\Transactions\Commissions;

abstract class AbstractCommission implements Commission
{
    const DEFAULT_COMMISSION_RATE = 0.003;
}