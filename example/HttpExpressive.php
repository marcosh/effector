<?php

declare(strict_types=1);

namespace Marcosh\EffectorExample;

use Marcosh\Effector\Compose;
use Marcosh\Effector\Effect\Http\EmitResponse;
use Marcosh\Effector\Effect\Http\ReceiveRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Application;
use Zend\Expressive\Router\FastRouteRouter;

/**
 * This example is building on the one contained in Http.php
 *
 * This is a static web application built using Zend Expressive.
 *
 * You could use this with `php -S localhost:8000 example/HttpExpressive.php`
 * and then browse to `localhost:8000` to check this is actually working.
 *
 * If you don't have php 7.1 installed in your machine, you could use docker with
 * `docker run --rm -ti -p 8000:8000 -v "$(pwd):/app" php:7.1-cli php -S 0.0.0.0:8000 /app/example/HttpExpressive.php`
 */

require __DIR__ . '/../vendor/autoload.php';

$expressive = new Application(
    new FastRouteRouter()
);

$expressive->pipeRoutingMiddleware();
$expressive->pipeDispatchMiddleware();

$expressive->get('/', function (ServerRequestInterface $request): ResponseInterface {
    return new HtmlResponse('<div>Welcome in a side effect free world!</div>');
});
$expressive->get('/ping', function (ServerRequestInterface $request): ResponseInterface {
    return new JsonResponse([
        'ack' => true
    ]);
});

$websiteLogic = function (ServerRequestInterface $request) use ($expressive): ResponseInterface {
    return $expressive->process($request, $expressive->getDefaultDelegate());
};

$app = Compose::pieces(
    new ReceiveRequest(),
    $websiteLogic,
    new EmitResponse()
);

$app();
