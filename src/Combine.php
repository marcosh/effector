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
        callable $first,
        callable $second,
        callable $then
    )
    {
        $this->first = $first;
        $this->second = $second;
        $this->then = $then;
    }

    public static function combine(
        callable $first,
        callable $second,
        callable $then
    ): self
    {
        return new self($first, $second, $then);
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
