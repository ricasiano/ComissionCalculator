<?php
namespace CommissionCalculator\Transactions\UserTypes;

class UserTypeException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid user type.');
    }
}