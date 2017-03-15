<?php

declare(strict_types = 1);

namespace Marcosh\EffectorTest\Effect\Output;

use PHPUnit\Framework\TestCase;

final class EchoTest extends TestCase
{
    public function testEcho()
    {
        $command = 'php ' . __DIR__ . '/echo.php';

        exec($command, $output);

        self::assertSame(['message'], $output);
    }
}
