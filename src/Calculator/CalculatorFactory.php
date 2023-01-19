<?php

declare(strict_types=1);

namespace Brohalskyi\Phptest\Calculator;

use Brohalskyi\Phptest\DataLoader;
use Brohalskyi\Phptest\Handlers\BinHandlers\BinlistHandler;
use Brohalskyi\Phptest\Handlers\RateHandlers\ExchangerateRateHandler;
use Brohalskyi\Phptest\Retrievers\BinRetriever;
use Brohalskyi\Phptest\Retrievers\RateRetriever;

class CalculatorFactory
{
    public function createCalculator(): CommissionCalculator
    {
        $dataLoader = new DataLoader();

        $binRetriever = new BinRetriever();
        $binRetriever->addHandler(new BinlistHandler($dataLoader));

        $rateRetriever = new RateRetriever();
        $rateRetriever->addHandler(new ExchangerateRateHandler($dataLoader));

        return new CommissionCalculator($binRetriever, $rateRetriever);
    }
}