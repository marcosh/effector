<?php

declare(strict_types = 1);

namespace Marcosh\Effector\Effect\Input;

final class Argv
{
    public function __invoke()
    {
        return $_SERVER['argv'];
    }
}
