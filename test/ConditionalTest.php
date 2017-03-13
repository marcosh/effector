<?php

declare(strict_types = 1);

namespace Marcosh\EffectorTest;

use Marcosh\Effector\Conditional;
use PHPUnit\Framework\TestCase;

final class ConditionalTest extends TestCase
{
    public function testConditionalCorrectlyExecutesFirstCondition()
    {
        $conditional = Conditional::ifThenElse(
            function () {return true;},
            function () {return 'then';},
            function () {return 'else';}
        );

        self::assertSame('then', $conditional());
    }

    public function testConditionalCorrectlyExceutesSecondCondition()
    {
        $conditional = Conditional::ifThenElse(
            function () {return false;},
            function () {return 'then';},
            function () {return 'else';}
        );

        self::assertSame('else', $conditional());
    }

    public function testConditionalCorrectlyDiscriminatesAccordingToArgs()
    {
        $conditional = Conditional::ifThenElse(
            function (int $x) {return $x > 0;},
            function (int $x) {return $x + 3;},
            function (int $x) {return $x - 3;}
        );

        self::assertSame(26, $conditional(23));
        self::assertSame(-26, $conditional(-23));
    }
}
