<?php

declare(strict_types = 1);

namespace Marcosh\EffectorTest;

use Eris\Generator;
use Eris\TestTrait;
use Marcosh\Effector\Compose;
use PHPUnit\Framework\TestCase;

final class ComposeTest extends TestCase
{
    use TestTrait;

    public function testComposeOfZeroPiecesIsTheIdentityFunction()
    {
        $this->forAll(
            Generator\choose(0, 1000)
        )->then(function ($number) {
            $compose = Compose::pieces();

            self::assertSame($number, $compose($number));
        });
    }

    public function testComposeOFOnePieceIsTheIdentityFunctor()
    {
        $this->forAll(
            Generator\choose(0, 1000),
            Generator\choose(0, 1000)
        )->then(function ($add, $number) {
            $callable = function ($x) use ($add) {return $x + $add;};

            $compose = Compose::pieces($callable);

            self::assertSame($callable($number), $compose($number));
        });
    }

    public function testComposeOnMultiplePiecesIsComposition()
    {
        $this->forAll(
            Generator\choose(0, 1000),
            Generator\choose(0, 1000),
            Generator\choose(0, 1000)
        )->then(function ($add, $mult, $number) {
            $first = function ($x) use ($add) {return $x + $add;};
            $second = function ($y) use ($mult) {return $y * $mult;};

            $compose = Compose::pieces($first, $second);

            self::assertSame(($number + $add) * $mult, $compose($number));
        });
    }

    public function testComposeOfNotCallableThrowsInvalidArgumentException()
    {
        self::expectException(\TypeError::class);
        self::expectExceptionMessage('Argument 1 passed to Marcosh\Effector\Compose::pieces() must be callable, integer given');

        Compose::pieces(23);
    }

    public function testComposeIterable()
    {
        $this->forAll(
            Generator\choose(0, 1000),
            Generator\choose(0, 1000),
            Generator\choose(0, 1000),
            Generator\choose(0, 1000)
        )->then(function ($add, $mult, $sub, $number) {
            $iterable = (function () use ($add, $mult, $sub) {
                yield function ($x) use ($add) {return $x + $add;};
                yield function ($x) use ($mult) {return $x * $mult;};
                yield function ($x) use ($sub) {return $x - $sub;};
            })();

            $compose = Compose::iterable($iterable);

            self::assertSame((($number + $add) * $mult) - $sub, $compose($number));
        });
    }
}
