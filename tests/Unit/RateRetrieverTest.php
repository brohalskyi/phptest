<?php

declare(strict_types=1);

use Brohalskyi\Phptest\DataLoader;
use Brohalskyi\Phptest\Handlers\RateHandlers\ExchangerateRateHandler;
use Brohalskyi\Phptest\Retrievers\RateRetriever;
use PHPUnit\Framework\TestCase;

class RateRetrieverTest extends TestCase
{
    public function testReturnValidHandler()
    {
        $dataLoader = $this->getMockBuilder(DataLoader::class)->getMock();
        $rateHandler = new ExchangerateRateHandler($dataLoader);

        $rateRetriever = new RateRetriever();
        $rateRetriever->addHandler($rateHandler);

        $this->assertSame($rateHandler, $rateRetriever->retrieveHandler());
    }

    public function testExceptionMessage()
    {
        $rateRetriever = new RateRetriever();
        $handler = null;
        $message = null;

        try {
            $handler = $rateRetriever->retrieveHandler();
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        $this->assertNull($handler);
        $this->assertSame($message, 'Logic error: there is no appropriate rate handler.');
    }
}