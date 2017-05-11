<?php

declare(strict_types=1);

namespace Marcosh\EffectorTest\Effect\PDO;

use Marcosh\Effector\Effect\PDO\Query;
use Marcosh\EffectorTest\MockeryTrait;
use PHPUnit\Framework\TestCase;

final class QueryTest extends TestCase
{
    use MockeryTrait;

    public function testQuery(): void
    {
        $argument = 'SELECT something';
        $result = 37;

        $connection = \Mockery::mock(\PDO::class);
        $connection->shouldReceive('query')->with($argument, \PDO::ATTR_DEFAULT_FETCH_MODE, null, null)->andReturn($result);

        self::assertSame($result, (new Query($connection))($argument));
    }
}
