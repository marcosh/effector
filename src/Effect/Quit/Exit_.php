<?php

declare(strict_types = 1);

namespace Marcosh\Effector\Effect\Quit;

final class Exit_
{
    public function __invoke(string $status)
    {
        exit($status);
    }
}
