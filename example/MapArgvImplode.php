<?php

declare(strict_types = 1);

namespace Marcosh\EffectorExample;

use Marcosh\Effector\Compose;
use Marcosh\Effector\Effect\Input\Argv;
use Marcosh\Effector\Effect\Output\Echo_;

require __DIR__ . '/../vendor/autoload.php';

// we map Argv with implode
$implodeArgv = Compose::pieces(
    new Argv(),
    function (array $strings) {return implode($strings) . PHP_EOL;}
);

$compose = Compose::pieces(
    $implodeArgv,
    new Echo_()
);

$compose();
