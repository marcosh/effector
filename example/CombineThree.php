<?php

declare(strict_types=1);

namespace Marcosh\EffectorExample;

use Marcosh\Effector\Compose;
use Marcosh\Effector\Effect\Output\Echo_;
use Marcosh\Effector\LazyParam;

require __DIR__ . '/../vendor/autoload.php';

$sumThree = function ($a, $b, $c) {
    return $a + $b + $c;
};

$const = function ($x) {
    return function () use ($x) {
        return $x;
    };
};

$combine = LazyParam::lazyParameters($sumThree, $const(1), $const(2), $const(3))()()();

$compose = Compose::pieces(
    $combine,
    function (int $int) {return (string) $int . PHP_EOL;},
    new Echo_()
);

$compose();
