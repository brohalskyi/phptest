<?php

declare(strict_types=1);

namespace Brohalskyi\Phptest\Handlers\BinHandlers;

use Brohalskyi\Phptest\Handlers\HandlerInterface;

interface BinHandlerInterface extends HandlerInterface
{
    public function loadData(int $bin): self;

    public function getCountryAlpha2(): string;
}