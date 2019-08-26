<?php

namespace CommissionCalculator\Transactions;

use CommissionCalculator\Transactions\Exceptions\InvalidUserIdException;

class UserId
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
        $this->validateUserId();
    }

    private function validateUserId()
    {
        if (!is_numeric($this->userId) || strpos($this->userId, '.')) {
            throw new InvalidUserIdException();
        }
    }

    public function getUserId()
    {
        return (int) $this->userId;
    }
}
