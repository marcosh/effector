<?php

declare(strict_types = 1);

namespace Marcosh\EffectorExample;

use Marcosh\Effector\Compose;
use Marcosh\Effector\Conditional;
use Marcosh\Effector\Effect\Input\Readline;
use Marcosh\Effector\Effect\Quit\Exit_;

require __DIR__ . '/../vendor/autoload.php';

$readOrQuit = Conditional::ifThenElse(
    function (string $prompt) {return $prompt === 'quit';},
    new Exit_(),
    new Readline()
);

$readUntilQuit = Compose::iterable((function () use ($readOrQuit) {
    while (true) {
        yield $readOrQuit;
    }
})());

$readUntilQuit('Type "stop" to end the execution');
