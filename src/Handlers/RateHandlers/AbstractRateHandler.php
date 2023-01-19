<?php

declare(strict_types=1);
namespace Brohalskyi\Phptest\Handlers\RateHandlers;

use Brohalskyi\Phptest\DataLoader;

abstract class AbstractRateHandler implements RateHandlerInterface
{
    public function __construct(protected DataLoader $dataLoader)
    {}

    protected array $rates;
}