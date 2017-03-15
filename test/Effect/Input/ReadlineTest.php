<?php

declare(strict_types = 1);

namespace Marcosh\EffectorTest\Effect\Input;

use Marcosh\Effector\Effect\Input\Readline;
use phpmock\mockery\PHPMockery;
use PHPUnit\Framework\TestCase;

final class ReadlineTest extends TestCase
{
    public function setUp()
    {
        $this->readlineMock = PHPMockery::mock('Marcosh\Effector\Effect\Input', 'readline');
    }

    public function testReadline()
    {
        $this->readlineMock->with('input')->once()->andReturn('output');

        $readline = new Readline();

        $output = $readline('input');

        self::assertSame('output', $output);
    }

    public function tearDown()
    {
        \Mockery::close();
    }
}
