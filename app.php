<?php

use Brohalskyi\Phptest\CalculationData;
use Brohalskyi\Phptest\Calculator\CalculatorFactory;
use Brohalskyi\Phptest\JsonDecoder;

require __DIR__ . '/vendor/autoload.php';

$decoder = new JsonDecoder();
$calculator = (new CalculatorFactory())->createCalculator();

try {
    if (!isset($argv[1])) {
        throw new Exception('Source file with data not provided.');
    }

    $data = explode("\n", file_get_contents($argv[1]));

    foreach ($data as $row) {
        $datum = $decoder->decode($row);
        $res = number_format(
            $calculator->calculate(new CalculationData($datum['bin'], $datum['currency'], $datum['amount'])),
            2
        );

        echo "$res \n";
    }
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
    exit();
}

