<?php

declare(strict_types = 1);

namespace Marcosh\EffectorExample;

use Marcosh\Effector\Compose;
use Marcosh\Effector\Effect\Output\Echo_;

require __DIR__ . '/../vendor/autoload.php';

$echoer = function (string $string) {
    return [
        function () use ($string) {return $string;},
        new Echo_()
    ];
};

// This produces a side effect after the other
// It is similar to an endThen functionality
$compose = Compose::pieces(
    ... $echoer('ciao' . PHP_EOL),
    ... $echoer('hello' . PHP_EOL)
);

$compose();