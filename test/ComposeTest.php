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
        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Expected a callable. Got: integer');

        Compose::pieces(23);
    }
}
