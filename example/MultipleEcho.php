<?php

declare(strict_types = 1);

namespace Marcosh\EffectorExample;

use Marcosh\Effector\Compose;
use Marcosh\Effector\Effect\Output\Echo_;

require __DIR__ . '/../vendor/autoload.php';

$constant = function (string $string) {
    return function () use ($string) {return $string;};
};

// this function return a function with signature () => ()
$echoer = function (string $string) use ($constant) {
    return Compose::pieces(
        $constant($string),
        new Echo_()
    );
};

// This produces a side effect after the other
// It is similar to an andThen functionality
$compose = Compose::pieces(
    $echoer('ciao' . PHP_EOL),
    $echoer('hello' . PHP_EOL)
);

$compose();