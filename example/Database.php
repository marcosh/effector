<?php

declare(strict_types=1);

namespace Marcosh\EffectorExample;

use Marcosh\Effector\Compose;
use Marcosh\Effector\Effect\Output\Echo_;
use Marcosh\Effector\Effect\PDO\Prepare;
use Marcosh\Effector\Effect\PDOStatement\Execute;

require __DIR__ . '/../vendor/autoload.php';

$connection = new \PDO('sqlite::memory:');
$connection->exec('CREATE TABLE `table` (id INTEGER PRIMARY Key);');

$app = Compose::pieces(
    function (): string {return 'INSERT INTO `table` (id) VALUES (:id);';},
    new Prepare($connection),
    function (\PDOStatement $statement) {
        return (new Execute($statement))(['id' => 0]);
    },
    function (bool $result): string {
        return (string) $result . PHP_EOL;
    },
    new Echo_()
);

$app();

