<?php

declare(strict_types = 1);

namespace Marcosh\Effector\Effect\File;

final class FileGetContents
{
    /**
     * @param string $fileName
     * @return string|bool may return false on failure
     */
    public function __invoke(
        string $fileName,
        ?bool $useIncludePath = false,
        ?resource $context = null,
        int $offset = 0,
        ?int $maxLength = null
    ) {
        if (null === $maxLength) {
            return file_get_contents(
                $fileName,
                $useIncludePath,
                $context,
                $offset
            );
        }

        return file_get_contents(
            $fileName,
            $useIncludePath,
            $context,
            $offset,
            $maxLength
        );
    }
}
