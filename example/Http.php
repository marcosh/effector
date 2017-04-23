<?php

declare(strict_types = 1);

namespace Marcosh\EffectorExample;

use Marcosh\Effector\Compose;
use Marcosh\Effector\Effect\Http\EmitResponse;
use Marcosh\Effector\Effect\Http\ReceiveRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\TextResponse;

/**
 * You could use this as a web application.
 *
 * This is really a dumb application, but using PSR-7 middleware this could be easily
 * become something more interesting.
 *
 * You could use this with `php -S localhost:8000 example/Http.php`
 * and then browse to `localhost:8000` to check this is actually working.
 *
 * If you don't have php 7.1 installed in your machine, you could use docker with
 * `docker run --rm -ti -p 8000:8000 -v "$(pwd):/app" php:7.1-cli php -S 0.0.0.0:8000 /app/example/Http.php`
 */

require __DIR__ . '/../vendor/autoload.php';

$websiteLogic = function (RequestInterface $request): ResponseInterface {
    return new TextResponse((string) $request->getUri());
};

$app = Compose::pieces(
    new ReceiveRequest(),
    $websiteLogic,
    new EmitResponse()
);

$app();
