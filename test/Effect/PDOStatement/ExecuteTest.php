<?php

declare(strict_types=1);

namespace Marcosh\EffectorTest\Effect\PDOStatement;

use Marcosh\Effector\Effect\PDOStatement\Execute;
use PHPUnit\Framework\TestCase;

final class ExecuteTest extends TestCase
{
    public function testExecute(): void
    {
        $inputParameters = ['key' => 'value'];

        $pdoStatement = \Mockery::mock(\PDOStatement::class);
        $pdoStatement->shouldReceive('execute')->with($inputParameters)->andReturn(true);

        self::assertTrue((new Execute($pdoStatement))($inputParameters));
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
