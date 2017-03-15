<?php

declare(strict_types = 1);

namespace Marcosh\EffectorTest\Effect\Input;

use Marcosh\Effector\Effect\Input\Argv;
use PHPUnit\Framework\TestCase;

final class ArgvTest extends TestCase
{
    public function testArgvReturnsServerArgs()
    {
        $_SERVER['argv'] = ['value'];

        $argv = new Argv();

        self::assertSame(['value'], $argv());
    }
}
