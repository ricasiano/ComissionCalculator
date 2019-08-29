<?php
namespace CommissionCalculator\Transactions;

use CommissionCalculator\Transactions\Commissions\CommissionFactory;
use CommissionCalculator\Transactions\CurrencyRates\CurrencyRateFactory;
use CommissionCalculator\Transactions\TransactionTypes\TransactionTypeFactory;
use CommissionCalculator\Transactions\UserTypes\UserTypeFactory;

class CommissionCalculator
{
    public function __construct(array $data)
    {
        $operationDate = new OperationDate($data[0]);
        $userId = new UserId($data[1]);

        $userTypeFactory = new UserTypeFactory($data[2]);
        $userType = $userTypeFactory->createUserType();

        $transactionTypeFactory = new TransactionTypeFactory($data[3]);
        $transactionType = $transactionTypeFactory->createTransactionType();

        $operationAmount = new OperationAmount($data[3]);
        $currencyRateFactory = new CurrencyRateFactory($data[4], 'EUR');
        $currencyRate = $currencyRateFactory->createCurrencyRate();

        $currencyConverter = new CurrencyConverter($currencyRate, $data[3]);

        $operationAmount = new OperationAmount($currencyConverter->computeConvertedAmount());
        $currency = $currencyRateFactory->createCurrencyRate();

        $commissionFactory = new CommissionFactory($transactionType, $userType);
        $commission = $commissionFactory->createCommission();
        
    }

}