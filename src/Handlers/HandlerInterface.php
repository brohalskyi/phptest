<?php

declare(strict_types=1);

namespace Brohalskyi\Phptest\Handlers;

interface HandlerInterface
{
    public function getProviderName(): string;
}