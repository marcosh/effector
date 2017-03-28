<?php

declare(strict_types=1);

namespace Marcosh\EffectorTest;

use Eris\Generator;
use Eris\TestTrait;
use Marcosh\Effector\LazyParam;
use PHPUnit\Framework\TestCase;

final class LazyParamTest extends TestCase
{
    use TestTrait;

    public function testLazyParametersWithoutParametersIsIdentityFunctor()
    {
        $this->forAll(
            Generator\choose(0, 1000),
            Generator\choose(0, 1000)
        )->then(function ($int, $add) {
            $f = function ($x) use ($add) {
                return $x + $add;
            };

            self::assertSame(
                $f($int),
                LazyParam::lazyParameters($f)($int)
            );
        });
    }

    public function testLazyParametersWithOneLazyParameter()
    {
        $this->forAll(
            Generator\choose(0, 1000),
            Generator\choose(0, 1000),
            Generator\choose(0, 1000)
        )->then(function ($add, $paramAdd, $int) {
            $f = function ($x) use ($add) {
                return $x + $add;
            };

            $param = function ($y) use ($paramAdd) {
                return $y + $paramAdd;
            };

            self::assertSame(
                $add + $paramAdd + $int,
                LazyParam::lazyParameters($f, $param)($int)()
            );
        });
    }

    public function testLazyParametersWithoutArgs()
    {
        $this->forAll(
            Generator\choose(0, 1000),
            Generator\choose(0, 1000)
        )->then(function ($firstResult, $secondResult) {
            $first = function () use ($firstResult) {
                return $firstResult;
            };

            $second = function () use ($secondResult) {
                return $secondResult;
            };

            $sum = function ($a, $b) {
                return $a + $b;
            };

            $combine = LazyParam::lazyParameters($sum, $first, $second);

            self::assertSame(
                $firstResult + $secondResult,
                $combine()()()
            );
        });
    }

    public function testLazyParametersWithSingleArg()
    {
        $this->forAll(
            Generator\choose(0, 1000),
            Generator\choose(0, 1000),
            Generator\choose(0, 1000),
            Generator\choose(0, 1000)
        )->then(function ($firstInput, $secondInput, $firstAdd, $secondAdd) {
            $first = function ($x) use ($firstAdd) {
                return $x + $firstAdd;
            };

            $second = function ($y) use ($secondAdd) {
                return $y + $secondAdd;
            };

            $sum = function ($a, $b) {
                return $a + $b;
            };

            $combine = LazyParam::lazyParameters($sum, $first, $second);

            self::assertSame(
                $firstInput + $firstAdd + $secondInput + $secondAdd,
                $combine($firstInput)($secondInput)()
            );
        });
    }

    public function testLazyParametersWithMultipleArgs()
    {
        $this->forAll(
            Generator\choose(0, 1000),
            Generator\choose(0, 1000),
            Generator\choose(0, 1000),
            Generator\choose(0, 1000)
        )->then(function ($firstInputOne, $firstInputTwo, $secondInputOne, $secondInputTwo) {
            $sum = function ($a, $b) {
                return $a + $b;
            };

            $combine = LazyParam::lazyParameters($sum, $sum, $sum);

            self::assertSame(
                $firstInputOne + $firstInputTwo + $secondInputOne + $secondInputTwo,
                $combine($firstInputOne, $firstInputTwo)($secondInputOne, $secondInputTwo)()
            );
        });
    }
}
