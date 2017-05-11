<?php

declare(strict_types=1);

namespace Marcosh\EffectorTest\Effect\Http;

use Marcosh\Effector\Effect\Http\EmitResponse;
use Marcosh\EffectorTest\MockeryTrait;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\EmitterInterface;

final class EmitResponseTest extends TestCase
{
    use MockeryTrait;

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
}
