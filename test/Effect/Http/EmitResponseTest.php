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
        $emitter = \Mockery::spy(EmitterInterface::class);

        $emitResponse = new EmitResponse($emitter);
        $response = new Response();

        $emitResponse($response);

        $emitter->shouldHaveReceived('emit')->with($response);
    }
}
