<?php

declare(strict_types = 1);

namespace Marcosh\Effector;

use Webmozart\Assert\Assert;

final class Compose
{
    private $pieces;

    private function __construct(array $pieces)
    {
        Assert::allIsCallable($pieces);

        $this->pieces = $pieces;
    }

    public static function pieces(... $pieces)
    {
        return new self($pieces);
    }

    public function __invoke(... $args)
    {
        foreach ($this->pieces as $piece) {
            $args = [$piece(... $args)];
        }

        return $args[0];
    }
}
