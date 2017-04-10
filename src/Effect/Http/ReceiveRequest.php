<?php

declare(strict_types=1);

namespace Marcosh\Effector\Effect\Http;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequestFactory;

final class ReceiveRequest
{
    public function __invoke(): ServerRequestInterface
    {
        return ServerRequestFactory::fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        );
    }
}
