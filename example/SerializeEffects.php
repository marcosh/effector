<?php

declare(strict_types=1);

namespace Marcosh\EffectorExample;

use Marcosh\Effector\Compose;
use Marcosh\Effector\Effect\Http\EmitResponse;
use Marcosh\Effector\Effect\Http\ReceiveRequest;
use function Opis\Closure\serialize;
use function Opis\Closure\unserialize;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\TextResponse;

require __DIR__ . '/../vendor/autoload.php';

/**
 * This example produces the same effects as Http.php
 *
 * Still, it adds the fact that the application is serialized and unserialized
 * before being executed
 */

$websiteLogic = function (RequestInterface $request): ResponseInterface {
    return new TextResponse((string) $request->getUri());
};

$app = Compose::pieces(
    new ReceiveRequest(),
    $websiteLogic,
    new EmitResponse()
);

$serializedApp = serialize($app);

$unserializedApp = unserialize($serializedApp, true);

$unserializedApp();
