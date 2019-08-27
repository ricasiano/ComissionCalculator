<?php

namespace CommissionCalculator\Transactions\UserTypes;

class UserTypeFactory
{
    private $userType;
    private $classUserType;

    public function __construct(string $userType)
    {
        $this->userType = $userType;
        $this->classUserType = __NAMESPACE__ . "\\" . (ucfirst(strtolower($this->userType)));
        $this->validateUserType();
    }

    private function validateUserType()
    {
        if (!class_exists($this->classUserType)) {
            throw new UserTypeException();
        }
    }

    public function createUserType(): UserType
    {
        return new $this->classUserType();
    }
}
