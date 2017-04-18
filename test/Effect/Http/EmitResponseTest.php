<?php

declare(strict_types=1);

namespace Marcosh\EffectorTest\Effect\Http;

use Marcosh\Effector\Effect\Http\EmitResponse;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\EmitterInterface;

final class EmitResponseTest extends TestCase
{
    public function testEmitsResponseCorrectly()
    {
        // we will be able to use spies with correct assertion count
        // from the next mockery version
        $emitter = \Mockery::mock(EmitterInterface::class);

        $emitResponse = new EmitResponse($emitter);
        $response = new Response();

        $emitter->shouldReceive('emit')->with($response);

        $emitResponse($response);
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
