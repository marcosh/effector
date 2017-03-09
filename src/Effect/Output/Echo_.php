<?php

declare(strict_types = 1);

namespace Marcosh\Effector\Effect\Output;

final class Echo_
{
    public function __invoke(string $string): void
    {
        echo $string;
    }
}
