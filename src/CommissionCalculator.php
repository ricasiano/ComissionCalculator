<?php
namespace CommissionCalculator;

use CommissionCalculator\Commissions\CommissionFactory;
use CommissionCalculator\CurrencyRates\CurrencyRateFactory;
use CommissionCalculator\Transactions\Transaction;
use CommissionCalculator\Transactions\Transactions;

class CommissionCalculator
{
    const LOG_FILE = 'commission_calculator.log';
    private $rawTransactions;

    public function __construct(array $rawTransactions)
    {
        $this->rawTransactions = $rawTransactions;
    }

    public function calculate()
    {
        if (file_exists(self::LOG_FILE)) {
            unlink(self::LOG_FILE);
        }

        try {
            $transactions = new Transactions();

            array_walk($this->rawTransactions, function($rawTransaction) use($transactions) {

                $rawTransaction[3] = $this->convertCurrency($rawTransaction[5], 'EUR', $rawTransaction[3]);

                $transaction = new Transaction($rawTransaction);
                $transactions->attach($transaction);

                $commissionFactory = new CommissionFactory($transactions);
                $commission = $commissionFactory->createCommission();
                $commissionAmount = $commission->computeCommission();

                $convertedCommissionAmount = $this
                    ->convertCurrency('EUR', $rawTransaction[5], $commissionAmount);

                echo "$convertedCommissionAmount\n";
            });
        } catch (\Exception $e) {
            file_put_contents(self::LOG_FILE, $e->getMessage() . "\n");
        }
    }

    private function convertCurrency($sourceCurrency, $targetCurrency, $amount)
    {
        $currencyRateFactory = new CurrencyRateFactory($sourceCurrency, $targetCurrency);
        $currencyRate = $currencyRateFactory->createCurrencyRate();
        $currencyConverter = new CurrencyConverter($currencyRate, $amount);

        return $currencyConverter->computeConvertedAmount();
    }
}