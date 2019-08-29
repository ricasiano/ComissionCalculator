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

            array_walk($this->rawTransactions, function ($rawTransaction) use ($transactions) {
                $originalNumber = $rawTransaction[4];
                $rawTransaction[4] = $this->convertCurrency($rawTransaction[5], 'EUR', $originalNumber);
                $transaction = new Transaction($rawTransaction);
                $transactions->attach($transaction);
                $commissionFactory = new CommissionFactory($transactions, $transaction);
                $commission = $commissionFactory->createCommission();
                $commissionAmount = $commission->computeCommission();
                $convertedCommissionAmount =
                    $this->convertCurrency('EUR', $rawTransaction[5], $commissionAmount);

                $convertedCommissionAmount = number_format($convertedCommissionAmount, 3 , '.', '');
                $numberResultFormatter = new NumberResultFormatter(
                    (string) $originalNumber,
                    $convertedCommissionAmount
                );
                echo $numberResultFormatter->formatNumber() . "\n";
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