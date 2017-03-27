<?php

declare(strict_types=1);

namespace Marcosh\Effector;

final class Combine
{
    /**
     * @var callable
     */
    private $first;

    /**
     * @var callable
     */
    private $second;

    /**
     * @var callable
     */
    private $then;

    private function __construct(
        callable $then,
        callable $first,
        callable $second
    )
    {
        $this->then = $then;
        $this->first = $first;
        $this->second = $second;
    }

    public static function combine(
        callable $then,
        callable $first,
        callable $second
    ): self
    {
        return new self($then, $first, $second);
    }

    public function __invoke(... $firstArgs)
    {
        return function (... $secondArgs) use ($firstArgs) {
            return ($this->then)(
                ($this->first)(... $firstArgs),
                ($this->second)(... $secondArgs)
            );
        };
    }
}
