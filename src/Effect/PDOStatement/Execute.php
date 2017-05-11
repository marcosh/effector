<?php

declare(strict_types=1);

namespace Marcosh\Effector\Effect\PDOStatement;

final class Execute
{
    /**
     * @var \PDOStatement
     */
    private $pdoStatement;

    public function __construct(\PDOStatement $pdoStatement)
    {
        $this->pdoStatement = $pdoStatement;
    }

    public function __invoke(array $inputParameters): bool
    {
        return $this->pdoStatement->execute($inputParameters);
    }
}
