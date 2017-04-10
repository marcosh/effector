<?php

declare(strict_types=1);

namespace Marcosh\EffectorTest\Effect\Http;

use Marcosh\Effector\Effect\Http\ReceiveRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\UploadedFile;

final class ReceiveRequestTest extends TestCase
{
     public function testCreatesServerRequestWithCorrectParameters()
    {
        $receiveRequest = new ReceiveRequest();

        $_SERVER = ['a'];
        $_GET = ['b'];
        $_POST = ['c'];
        $_COOKIE = ['d'];

        $uploadedFile = new UploadedFile('dev/null', 0,0);
        $_FILES = ['SCRIPT_NAME' => $uploadedFile];

        $request = $receiveRequest();

        self::assertInstanceOf(ServerRequestInterface::class, $receiveRequest());
        self::assertSame(['a'], $request->getServerParams());
        self::assertSame(['b'], $request->getQueryParams());
        self::assertSame(['c'], $request->getParsedBody());
        self::assertSame(['d'], $request->getCookieParams());
        self::assertSame(['SCRIPT_NAME' => $uploadedFile], $request->getUploadedFiles());

    }
}
