<?php

declare(strict_types=1);

namespace Marcosh\Effector;

final class LazyParam
{
    /**
     * @var callable
     */
    private $function;

    /**
     * @var callable[]
     */
    private $parameters;

    private function __construct(
        callable $function,
        callable ... $parameters
    )
    {
        $this->function = $function;
        $this->parameters = $parameters;
    }

    public static function combine(
        callable $function,
        callable ... $parameters
    ): self
    {
        return new self($function, ... $parameters);
    }

    public function __invoke(... $parameterInput)
    {
        if ([] === $this->parameters) {
            return ($this->function)(... $parameterInput);
        }

        $nextParameter = $this->parameters[0];

        $otherParameters = array_slice($this->parameters, 1);

        return self::combine(
            function (... $parameters) use ($nextParameter, $parameterInput) {
                return ($this->function)(
                    $nextParameter(... $parameterInput),
                    ... $parameters
                );
            },
            ... $otherParameters
        );
    }
}
