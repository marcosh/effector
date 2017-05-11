<?php

declare(strict_types=1);

namespace Marcosh\Effector\Effect\PDO;

final class Prepare
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
     * @return \PDOStatement|false
     * @throws \PDOException
     */
    public function __invoke(string $statement, array $driverOptions = [])
    {
        return $this->connection->prepare($statement, $driverOptions);
    }
}
