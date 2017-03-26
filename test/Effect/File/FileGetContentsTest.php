<?php

declare(strict_types = 1);

namespace Marcosh\EffectorTest\Effect\File;

use Marcosh\Effector\Effect\File\FileGetContents;
use PHPUnit\Framework\Error\Warning;
use PHPUnit\Framework\TestCase;

final class FileGetContentsTest extends TestCase
{
    public function testFileGetContentsRetrievesFileContent()
    {
        $fileGetContents = new FileGetContents();

        self::assertSame('hello!', $fileGetContents(__DIR__ . '/fixture.txt'));
    }

    public function testFileGetContentsRetrievesFileContentWithIncludePath()
    {
        self::markTestIncomplete();
    }

    public function testFileGetContentsRetrievesFileContentWithContext()
    {
        self::markTestIncomplete();
    }

    public function testFileGetContentsRetrievesFileContentWithOffset()
    {
        $fileGetContents = new FileGetContents();

        self::assertSame('llo!', $fileGetContents(__DIR__ . '/fixture.txt', false, null, 2));
    }

    public function testFileGetContentsRetrievesFileContentWithMaxLength()
    {
        $fileGetContents = new FileGetContents();

        self::assertSame('hell', $fileGetContents(__DIR__ . '/fixture.txt', false, null, 0, 4));
    }

    public function testFileGetContentsFailsInNoFileIsFound()
    {
        $this->expectException(Warning::class);
        $this->expectExceptionMessage(
            'file_get_contents(' . __DIR__ . '/not-existing-file.txt): ' .
            'failed to open stream: No such file or directory'
        );

        $fileGetContents = new FileGetContents();

        $fileGetContents(__DIR__ . '/not-existing-file.txt');
    }
}
