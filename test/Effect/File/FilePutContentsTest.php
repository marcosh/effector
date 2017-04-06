<?php

declare(strict_types=1);

namespace Marcosh\EffectorTest\Effect\File;

use Marcosh\Effector\Effect\File\FilePutContents;
use PHPUnit\Framework\TestCase;

final class FilePutContentsTest extends TestCase
{
    private $fileName = 'writeTo.txt';

    public function testFilePutStringContents()
    {
        $text = 'hello!';

        $filePutContents = new FilePutContents();

        self::assertSame(6, $filePutContents($this->fileName, $text));
        self::assertStringEqualsFile($this->fileName, $text);
    }

    public function testFilePutArrayContents()
    {
        $text = ['hello', ' ', 'world'];

        $filePutContents = new FilePutContents();

        self::assertSame(11, $filePutContents($this->fileName, $text));
        self::assertStringEqualsFile($this->fileName, implode($text));
    }

    public function testFilePutStreamContents()
    {
        self::markTestIncomplete();
    }

    public function testFileAppendContents()
    {
        $firstText = 'hello';
        $secondText = ' world';

        $filePutContents = new FilePutContents();

        $filePutContents($this->fileName, $firstText);

        self::assertSame(6, $filePutContents($this->fileName, $secondText, FILE_APPEND));
        self::assertStringEqualsFile($this->fileName, $firstText . $secondText);
    }

    public function tearDown()
    {
        unlink($this->fileName);
    }
}
