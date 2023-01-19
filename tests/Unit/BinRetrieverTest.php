<?php

declare(strict_types=1);

use Brohalskyi\Phptest\DataLoader;
use Brohalskyi\Phptest\Handlers\BinHandlers\BinlistHandler;
use Brohalskyi\Phptest\Retrievers\BinRetriever;
use PHPUnit\Framework\TestCase;

class BinRetrieverTest extends TestCase
{
    public function testReturnValidHandler()
    {
        $dataLoader = $this->getMockBuilder(DataLoader::class)->getMock();
        $binlistHandler = new BinlistHandler($dataLoader);

        $binRetriever = new BinRetriever();
        $binRetriever->addHandler($binlistHandler);

        $this->assertSame($binlistHandler, $binRetriever->retrieveHandler());
    }

    public function testExceptionMessage()
    {
        $binRetriever = new BinRetriever();
        $handler = null;
        $message = null;

        try {
            $handler = $binRetriever->retrieveHandler();
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        $this->assertNull($handler);
        $this->assertSame($message, 'Logic error: there is no appropriate bin handler.');
    }
}