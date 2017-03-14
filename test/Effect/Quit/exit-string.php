<?php

declare(strict_types = 1);

require __DIR__ . '/../../../vendor/autoload.php';

$exit = new \Marcosh\Effector\Effect\Quit\Exit_();

$exit('the end');
