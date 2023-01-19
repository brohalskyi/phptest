<?php

declare(strict_types=1);

namespace Brohalskyi\Phptest\Calculator;

use Brohalskyi\Phptest\CalculationData;
use Brohalskyi\Phptest\Retrievers\{
    BinRetriever,
    RateRetriever
};

class CommissionCalculator
{
    private const COUNTRIES = [
        'AT',
        'BE',
        'BG',
        'CY',
        'CZ',
        'DE',
        'DK',
        'EE',
        'ES',
        'FI',
        'FR',
        'GR',
        'HR',
        'HU',
        'IE',
        'IT',
        'LT',
        'LU',
        'LV',
        'MT',
        'NL',
        'PO',
        'PT',
        'RO',
        'SE',
        'SI',
        'SK'
    ];

    public function __construct(
        private readonly BinRetriever $binRetriever,
        private readonly RateRetriever $rateRetriever
    ) {}

    public function calculate(CalculationData $data): float
    {
        $alpha2 = $this
            ->binRetriever
            ->retrieveHandler()
            ->loadData($data->getBin())
            ->getCountryAlpha2();

        $rate = $this
            ->rateRetriever
            ->retrieveHandler()
            ->loadRates()
            ->getRateForCurrency($data->getCurrency());

        $amntFixed = $this->getFixedAmount($data->getCurrency(), $data->getAmount(), $rate);

        return $amntFixed * ($this->isEuropean($alpha2) ? 0.01 : 0.02);
    }

    private function isEuropean($country): bool
    {
        return in_array($country, self::COUNTRIES);
    }

    private function getFixedAmount(string $currency, float $amount, float $rate): float | int
    {
        return ($currency == 'EUR' || $rate == 0) ? $amount : $amount / $rate;
    }
}