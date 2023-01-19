<?php

declare(strict_types=1);

namespace Brohalskyi\Phptest\Handlers\RateHandlers;

use Brohalskyi\Phptest\Handlers\HandlerInterface;

interface RateHandlerInterface extends HandlerInterface
{
    public function loadRates(): self;

    public function getRateForCurrency(string $currency): float | int;
}