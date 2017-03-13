<?php

declare(strict_types = 1);

namespace Marcosh\EffectorExample;

use Marcosh\Effector\Conditional;
use Marcosh\Effector\Effect\Input\Readline;
use Marcosh\Effector\Effect\Output\Echo_;

require __DIR__ . '/../vendor/autoload.php';

$readOrQuit = Conditional::ifThenElse(
    function (string $prompt) {return $prompt === 'quit';},
    new Echo_(),
    new Readline()
);

$readOrQuit('quit');