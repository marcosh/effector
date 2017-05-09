<?php

declare(strict_types=1);

namespace Marcosh\Effector\Effect\PDO;

final class Exec
{
    /**
     * @var \PDO
     */
    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return int|bool
     */
    public function __invoke(string $statement)
    {
        return $this->connection->exec($statement);
    }
}
