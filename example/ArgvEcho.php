<?php

declare(strict_types = 1);

namespace Marcosh\EffectorExample;

use Marcosh\Effector\Compose;
use Marcosh\Effector\Effect\Input\Argv;
use Marcosh\Effector\Effect\Output\Echo_;

require __DIR__ . '/../vendor/autoload.php';

$compose = Compose::pieces(
    new Argv(),
    function (array $args) {return implode($args);},
    new Echo_()
);

$compose();
