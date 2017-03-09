<?php

declare(strict_types = 1);

namespace Marcosh\Effector\Effect\Input;

final class Readline
{
    public function __invoke(string $prompt): string
    {
        return readline($prompt);
    }
}
