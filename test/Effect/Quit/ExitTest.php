<?php

declare(strict_types = 1);

namespace Marcosh\EffectorTest\Effect\Quit;

use PHPUnit\Framework\TestCase;

final class ExitTest extends TestCase
{
    public function testExitString()
    {
        $command = 'php ' . __DIR__ . '/exit-string.php';

        exec($command, $output, $return);

        self::assertSame(['the end'], $output);
    }

    public function testExitInt()
    {
        $command = 'php ' . __DIR__ . '/exit-int.php';

        exec($command, $output, $return);

        self::assertSame(23, $return);
    }
}
