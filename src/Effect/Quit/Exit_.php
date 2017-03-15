<?php

declare(strict_types = 1);

namespace Marcosh\Effector\Effect\Quit;

final class Exit_
{
    /**
     * @param string|int $status
     */
    public function __invoke($status): void
    {
        exit($status);
    }
}
