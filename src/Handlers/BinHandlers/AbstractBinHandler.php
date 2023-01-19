<?php

declare(strict_types=1);

namespace Brohalskyi\Phptest\Handlers\BinHandlers;

use Brohalskyi\Phptest\DataLoader;

abstract class AbstractBinHandler implements BinHandlerInterface
{
    public function __construct(protected readonly DataLoader $dataLoader)
    {}

    protected array $data;
}