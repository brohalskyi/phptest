<?php

declare(strict_types=1);

namespace Brohalskyi\Phptest\Handlers\BinHandlers;

use Brohalskyi\Phptest\Config;
use Exception;

class BinlistHandler extends AbstractBinHandler
{
    public function getProviderName(): string
    {
        return 'binlist';
    }

    public function loadData(int $bin): self
    {
        $url = Config::get('bin.url');
        $result = $this->dataLoader->load($url . $bin);

        if (!$result) {
            throw new Exception(sprintf('There is no data from %s', $url));
        }

        $this->data = json_decode($result, true);

        return $this;
    }

    public function getCountryAlpha2(): string
    {
        return $this->data['country']['alpha2'];
    }
}