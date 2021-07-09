<?php

declare(strict_types=1);

namespace Pollen\Support;

class Img
{
    /**
     * Get image source attribute in base64 format from filename.
     *
     * @param string $filename
     *
     * @return string|null
     */
    public static function getBase64Src(string $filename): ?string
    {
        if (file_exists($filename)) {
            $mime_type = mime_content_type($filename);

            return sprintf(
                'data:%s;base64,%s',
                $mime_type !== 'image/svg' ? $mime_type : 'image/svg+xml',
                base64_encode(file_get_contents($filename))
            );
        }
        return null;
    }
}