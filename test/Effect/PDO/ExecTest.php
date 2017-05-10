<?php

declare(strict_types=1);

namespace Marcosh\EffectorTest\Effect\PDO;

use Marcosh\Effector\Effect\PDO\Exec;
use PHPUnit\Framework\TestCase;

final class ExecTest extends TestCase
{
    public function testExec(): void
    {
        $argument = 'UPDATE something';
        $result = 37;

        $connection = \Mockery::mock(\PDO::class);
        $connection->shouldReceive('exec')->with($argument)->andReturn($result);

        self::assertSame($result, (new Exec($connection))($argument));
    }

    protected function assertPostConditions()
    {
        $container = \Mockery::getContainer();
        if ($container != null) {
            $count = $container->mockery_getExpectationCount();
            $this->addToAssertionCount($count);
        }

        \Mockery::close();
    }
}
