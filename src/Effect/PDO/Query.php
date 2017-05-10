<?php

declare(strict_types=1);

namespace Marcosh\Effector\Effect\PDO;

final class Query
{
    /**
     * @var \PDO
     */
    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function __invoke(
        string $statement,
        int $fetchMode = \PDO::ATTR_DEFAULT_FETCH_MODE,
        $arg = null,
        ?array $ctorArgs = null
    )
    {
        return $this->connection->query($statement, $fetchMode, $arg, $ctorArgs);
    }
}
