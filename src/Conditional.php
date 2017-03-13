<?php

declare(strict_types = 1);

namespace Marcosh\Effector;

final class Conditional
{
    /**
     * @var callable
     */
    private $if;

    /**
     * @var callable
     */
    private $then;

    /**
     * @var callable
     */
    private $else;

    private function __construct(callable $if, callable $then, callable $else)
    {
        $this->if = $if;
        $this->then = $then;
        $this->else = $else;
    }

    public static function ifThenElse(callable $if, callable $then, callable $else)
    {
        return new self($if, $then, $else);
    }

    public function __invoke(... $args)
    {
        if (($this->if)(... $args)) {
            return ($this->then)(... $args);
        } else {
            return ($this->else)(... $args);
        }
    }
}
