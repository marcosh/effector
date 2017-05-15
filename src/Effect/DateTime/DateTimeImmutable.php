<?php

declare(strict_types=1);

namespace Marcosh\Effector\Effect\DateTime;

final class DateTimeImmutable
{
    public function __invoke(?string $time = 'now', ?\DateTimeZone $timeZone = null): \DateTimeImmutable
    {
        return new \DateTimeImmutable($time, $timeZone);
    }
}
