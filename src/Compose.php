<?php

declare(strict_types = 1);

namespace Marcosh\Effector;

final class Compose
{
    /**
     * @var iterable
     */
    private $pieces;

    private function __construct(iterable $pieces)
    {
        $this->pieces = $pieces;
    }

    public static function pieces(callable ... $pieces)
    {
        return new self($pieces);
    }

    public static function iterable(iterable $iterable)
    {
        return new self($iterable);
    }

    public function __invoke(... $args)
    {
        foreach ($this->pieces as $piece) {
            $args = [$piece(... $args)];
        }

        return $args[0];
    }
}
