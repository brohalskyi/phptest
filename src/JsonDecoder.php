<?php

declare(strict_types=1);

namespace Brohalskyi\Phptest;

class JsonDecoder
{
    public function decode(string $string): array
    {
        $result = json_decode($string, true);

        if (json_last_error() || !isset($result['bin']) || !isset($result['currency']) || !isset($result['amount'])) {
            throw new \Exception('Invalid data provided. Check out input source.');
        }

        return $result;
    }
}