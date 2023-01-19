<?php

declare(strict_types=1);

use Brohalskyi\Phptest\DataLoader;
use Brohalskyi\Phptest\Handlers\RateHandlers\ExchangerateRateHandler;
use PHPUnit\Framework\TestCase;

class ExchangerateRateHandlerTest extends TestCase
{
    public function testGetRateForCurrency()
    {
        $res = '{"success":true,"base":"EUR","date":"2023-01-18","rates":{"AED":3.963475}}';

        $loader = $this->getMockBuilder(DataLoader::class)->getMock();
        $loader->expects($this->once())->method('load')->willReturn($res);

        $handler = new ExchangerateRateHandler($loader);
        $handler->loadRates();

        $this->assertSame(3.963475, $handler->getRateForCurrency('AED'));
    }

    public function testExceptionMessage()
    {
        $res = '';
        $loader = $this->getMockBuilder(DataLoader::class)->getMock();
        $loader->expects($this->once())->method('load')->willReturn($res);

        $handler = new ExchangerateRateHandler($loader);

        try {
            $handler->loadRates();
        } catch (Exception $e) {
            $this->assertSame($e->getMessage(), 'There is no data from https://api.exchangerate.host/latest');
        }
    }
}