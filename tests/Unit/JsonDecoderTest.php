<?php

declare(strict_types=1);

use Brohalskyi\Phptest\JsonDecoder;
use PHPUnit\Framework\TestCase;

class JsonDecoderTest extends TestCase
{
    public function testResult()
    {
        $decoder = new JsonDecoder();
        $result = [
            'bin' => 123,
            'currency' => 'EUR',
            'amount' => 100
        ];
        $this->assertSame($result, $decoder->decode(json_encode($result)));
    }

    public function testExceptionInvalidString()
    {
        $decoder = new JsonDecoder();

        try {
            $decoder->decode('qwe');
        } catch (Exception $e) {
            $this->assertSame('Invalid data provided. Check out input source.', $e->getMessage());
        }
    }

    public function testExceptionMissingData()
    {
        $decoder = new JsonDecoder();

        try {
             $decoder->decode(json_encode(['bin' => 123]));
        } catch (Exception $e) {
            $this->assertSame('Invalid data provided. Check out input source.', $e->getMessage());
        }
    }
}