<?php

declare(strict_types=1);

namespace Marcosh\EffectorTest\Effect\PDO;

use Marcosh\Effector\Effect\PDO\Prepare;
use PHPUnit\Framework\TestCase;

final class PrepareTest extends TestCase
{
    public function testPrepare(): void
    {
        $statement = 'SELECT something WHERE a = :a';
        $driverOptions = [
            \PDO::ATTR_CURSOR => \PDO::CURSOR_SCROLL
        ];
        $result = new \PDOStatement();

        $connection = \Mockery::mock(\PDO::class);
        $connection->shouldReceive('prepare')->with($statement, $driverOptions)->andReturn($result);

        self::assertSame($result, (new Prepare($connection))($statement, $driverOptions));
    }

    protected function assertPostConditions(): void
    {
        $container = \Mockery::getContainer();
        if (null !== $container) {
            $count = $container->mockery_getExpectationCount();
            $this->addToAssertionCount($count);
        }

        \Mockery::close();
    }
}
