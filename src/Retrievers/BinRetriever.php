<?php

declare(strict_types=1);

namespace Brohalskyi\Phptest\Retrievers;

use Brohalskyi\Phptest\Handlers\BinHandlers\{AbstractBinHandler, BinHandlerInterface};
use Brohalskyi\Phptest\Config;
use Exception;

class BinRetriever
{
    private array $handlers = [];

    public function addHandler(AbstractBinHandler $abstractBinHandler): void
    {
        $this->handlers[] = $abstractBinHandler;
    }

    public function retrieveHandler(): BinHandlerInterface
    {
        $binProvider = Config::get('bin.provider');

        foreach ($this->handlers as $handler) {
            if ($handler->getProviderName() === $binProvider) {
                return $handler;
            }
        }

        throw new Exception('Logic error: there is no appropriate bin handler.');
    }
}