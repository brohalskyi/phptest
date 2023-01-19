<?php

declare(strict_types=1);

namespace Brohalskyi\Phptest\Retrievers;

use Brohalskyi\Phptest\Config;
use Exception;
use Brohalskyi\Phptest\Handlers\RateHandlers\{AbstractRateHandler, RateHandlerInterface};

class RateRetriever
{
    private array $handlers = [];

    public function addHandler(AbstractRateHandler $abstractRateHandler): void
    {
        $this->handlers[] = $abstractRateHandler;
    }

    public function retrieveHandler(): RateHandlerInterface
    {
        $binProvider = Config::get('rate.provider');

        foreach ($this->handlers as $handler) {
            if ($handler->getProviderName() === $binProvider) {
                return $handler;
            }
        }

        throw new Exception('Logic error: there is no appropriate rate handler.');
    }
}