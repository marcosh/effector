<?php

declare(strict_types=1);

namespace Marcosh\Effector\Effect\Http;

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\EmitterInterface;
use Zend\Diactoros\Response\SapiEmitter;

final class EmitResponse
{
    /**
     * @var EmitterInterface|null
     */
    private $emitter;

    public function __construct(?EmitterInterface $emitter = null)
    {
        if (null === $emitter) {
            $emitter = new SapiEmitter();
        }

        $this->emitter = $emitter;
    }

    public function __invoke(ResponseInterface $response): void
    {
        $this->emitter->emit($response);
    }
}
