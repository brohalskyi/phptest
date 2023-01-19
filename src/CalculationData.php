<?php

declare(strict_types=1);

namespace Brohalskyi\Phptest;

class CalculationData
{
    public function __construct(
        private int $bin,
        private string $currency,
        private float $amount
    ) {}

    public function getBin(): int
    {
        return $this->bin;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}