<?php

declare(strict_types=1);

namespace Brohalskyi\Phptest;

class DataLoader
{
    public function load(string $url): string
    {
        return file_get_contents($url);
    }
}