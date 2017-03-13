<?php

declare(strict_types = 1);

namespace Marcosh\EffectorTest;

use Marcosh\Effector\Compose;

final class ComposeTest extends \PHPUnit\Framework\TestCase
{
    public function testComposeOfZeroPiecesIsTheIdentityFunction()
    {
        $compose = Compose::pieces();

        self::assertSame(23, $compose(23));
    }

    public function testComposeOFOnePieceIsTheIdentityFunctor()
    {
        $callable = function ($x) {return $x + 3;};

        $compose = Compose::pieces($callable);

        self::assertSame($callable(23), $compose(23));
    }

    public function testComposeOnMultiplePiecesIsComposition()
    {
        $first = function ($x) {return $x + 3;};
        $second = function ($y) {return $y * 2;};

        $compose = Compose::pieces($first, $second);

        self::assertSame(16, $compose(5));
    }

    public function testComposeOfNotCallableThrowsInvalidArgumentException()
    {
        self::expectException(\TypeError::class);
        self::expectExceptionMessage('Argument 1 passed to Marcosh\Effector\Compose::pieces() must be callable, integer given');

        Compose::pieces(23);
    }

    public function testComposeIterable()
    {
        $iterable = (function () {
            yield function ($x) {return $x + 3;};
            yield function ($x) {return $x * 2;};
            yield function ($x) {return $x - 7;};
        })();

        $compose = Compose::iterable($iterable);

        self::assertSame(37, $compose(19));
    }
}
