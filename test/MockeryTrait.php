<?php

declare(strict_types=1);

namespace Marcosh\EffectorTest;

trait MockeryTrait
{
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
