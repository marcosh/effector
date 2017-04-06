<?php

declare(strict_types=1);

namespace Marcosh\Effector\Effect\File;

final class FilePutContents
{
    /**
     * @param string $filename
     * @param string|array|resource $data
     * @param int $flags
     * @param resource $context
     * @return int|bool may return false on failure
     */
    public function __invoke(
        string $filename,
        $data,
        int $flags = 0,
        resource $context = null
    ): int
    {
        return file_put_contents($filename, $data, $flags, $context);
    }
}
