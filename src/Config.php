<?php

declare(strict_types=1);

namespace Brohalskyi\Phptest;

use Noodlehaus\Config as VendorConfig;

class Config
{
    public static function get(string $key)
    {
        return VendorConfig::load(__DIR__ . '/../config/main.json')->get($key);
    }
}