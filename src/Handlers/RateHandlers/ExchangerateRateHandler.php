<?php

declare(strict_types=1);

namespace Brohalskyi\Phptest\Handlers\RateHandlers;

use Brohalskyi\Phptest\Config;
use Exception;

class ExchangerateRateHandler extends AbstractRateHandler
{
    public function getProviderName(): string
    {
        return 'exchangerate';
    }

    public function loadRates(): self
    {
        if (empty($this->rates)) {
            $url = Config::get('rate.url');
            $result = $this->dataLoader->load($url);

            if (!$result) {
                throw new Exception(sprintf('There is no data from %s', $url));
            }

            $this->rates = json_decode($result, true);
        }

        return $this;
    }

    public function getRateForCurrency(string $currency): float | int
    {
        return $this->rates['rates'][$currency];
    }
}