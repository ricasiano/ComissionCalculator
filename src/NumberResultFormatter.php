<?php

namespace CommissionCalculator;

class NumberResultFormatter
{
    private $decimalPlaces;
    private $numberToBeFormatted;
    public function __construct($modelNumber, $numberToBeFormatted, $decimalSeparator = '.')
    {
        $this->numberToBeFormatted = number_format($numberToBeFormatted, 3 , '.', '');
        $this->decimalPlaces = strlen(substr(strrchr((string) $modelNumber, $decimalSeparator), 1));
    }

    public function formatNumber()
    {
        return $this->decimalizeNumber();
    }

    private function decimalizeNumber()
    {
        if (0 == $this->decimalPlaces) {
            return ceil($this->numberToBeFormatted);
        }

        $pow = pow(10, $this->decimalPlaces);
        $normalizeDecimalPlaces = ceil($this->numberToBeFormatted * $pow) / $pow;

        return number_format($normalizeDecimalPlaces, $this->decimalPlaces, '.', '');
    }
}
