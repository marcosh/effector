<?php

declare(strict_types=1);

namespace Marcosh\EffectorTest\Effect\DateTime;

use Marcosh\Effector\Effect\DateTime\DateTimeImmutable;
use PHPUnit\Framework\TestCase;

final class DateTimeImmutableTest extends TestCase
{
    public function testDateTimeImmutableWithoutArguments(): void
    {
        $dateTimeImmutable = new DateTimeImmutable();

        self::assertGreaterThanOrEqual(date_create_immutable(), $dateTimeImmutable());
        self::assertLessThanOrEqual(
            date_create_immutable()->add(new \DateInterval('PT1S')),
            $dateTimeImmutable()
        );
    }

    public function testDateTimeImmutableWithTimeArgument(): void
    {
        $dateTimeImmutable = new DateTimeImmutable();

        self::assertGreaterThanOrEqual(date_create_immutable('yesterday'), $dateTimeImmutable('yesterday'));
        self::assertLessThanOrEqual(
            date_create_immutable('yesterday')->add(new \DateInterval('PT1S')),
            $dateTimeImmutable('yesterday')
        );
    }

    public function testDateTimeImmutableWithTimeAndTimezoneArguments(): void
    {
        $dateTimeImmutable = new DateTimeImmutable();

        self::assertGreaterThanOrEqual(
            date_create_immutable('yesterday', new \DateTimeZone('Europe/London')),
            $dateTimeImmutable('yesterday', new \DateTimeZone('Europe/London'))
        );
        self::assertLessThanOrEqual(
            date_create_immutable('yesterday', new \DateTimeZone('Europe/London'))->add(new \DateInterval('PT1S')),
            $dateTimeImmutable('yesterday', new \DateTimeZone('Europe/London'))
        );
    }
}
