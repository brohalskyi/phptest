<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ExceptionOutputTest extends TestCase
{
    public function testOutput()
    {
        exec('php app.php', $output);

        $this->assertSame($output[0], 'Source file with data not provided.');
    }
}