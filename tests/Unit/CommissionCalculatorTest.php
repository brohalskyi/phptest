<?php

declare(strict_types=1);

use Brohalskyi\Phptest\CalculationData;
use Brohalskyi\Phptest\Calculator\CommissionCalculator;
use Brohalskyi\Phptest\DataLoader;
use Brohalskyi\Phptest\Handlers\BinHandlers\BinlistHandler;
use Brohalskyi\Phptest\Handlers\RateHandlers\ExchangerateRateHandler;
use Brohalskyi\Phptest\Retrievers\BinRetriever;
use Brohalskyi\Phptest\Retrievers\RateRetriever;
use PHPUnit\Framework\TestCase;

class CommissionCalculatorTest extends TestCase
{
    public function testResult()
    {
        $res1 = '{"number":{},"scheme":"mastercard","type":"debit","brand":"Debit","country":{"numeric":"440","alpha2":"LT","name":"Lithuania","emoji":"🇱🇹","currency":"EUR","latitude":56,"longitude":24},"bank":{}}';
        $res2 = '{"success":true,"base":"EUR","date":"2023-01-18","rates":{"AED":3.963475}}';

        $loader = $this->getMockBuilder(DataLoader::class)->getMock();
        $loader
            ->method('load')
            ->withConsecutive(['https://lookup.binlist.net/123'], ['https://api.exchangerate.host/latest'])
            ->willReturnOnConsecutiveCalls($res1, $res2);

        $binlistHandler = new BinlistHandler($loader);
        $binRetriever = new BinRetriever();
        $binRetriever->addHandler($binlistHandler);

        $rateHandler = new ExchangerateRateHandler($loader);
        $rateRetriever = new RateRetriever();
        $rateRetriever->addHandler($rateHandler);

        $calculator = new CommissionCalculator($binRetriever, $rateRetriever);

        $this->assertSame(
            0.2523038495259841,
            $calculator->calculate(new CalculationData(123, 'AED', 100))
        );
    }
}