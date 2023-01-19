<?php

declare(strict_types=1);

use Brohalskyi\Phptest\DataLoader;
use Brohalskyi\Phptest\Handlers\BinHandlers\BinlistHandler;
use PHPUnit\Framework\TestCase;

class BinListHandlerTest extends TestCase
{
    public function testGetCountryAlpha()
    {
        $res = '{"number":{},"scheme":"mastercard","type":"debit","brand":"Debit","country":{"numeric":"440","alpha2":"LT","name":"Lithuania","emoji":"🇱🇹","currency":"EUR","latitude":56,"longitude":24},"bank":{}}';

        $loader = $this->getMockBuilder(DataLoader::class)->getMock();
        $loader->expects($this->once())->method('load')->willReturn($res);

        $handler = new BinlistHandler($loader);
        $handler->loadData(123);

        $this->assertSame('LT', $handler->getCountryAlpha2());
    }

    public function testExceptionMessage()
    {
        $res = '';
        $loader = $this->getMockBuilder(DataLoader::class)->getMock();
        $loader->expects($this->once())->method('load')->willReturn($res);

        $handler = new BinlistHandler($loader);

        try {
            $handler->loadData(123);
        } catch (Exception $e) {
            $this->assertSame($e->getMessage(), 'There is no data from https://lookup.binlist.net/');
        }
    }
}