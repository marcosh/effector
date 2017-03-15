<?php

declare(strict_types = 1);

require __DIR__ . '/../../../vendor/autoload.php';

$echo = new \Marcosh\Effector\Effect\Output\Echo_();

$echo('message');
