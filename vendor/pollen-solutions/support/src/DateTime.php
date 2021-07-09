<?php

declare(strict_types=1);

namespace Pollen\Support;

use Carbon\Carbon;
use Exception;

class DateTime extends Carbon
{
    /**
     * Default date format.
     * @var string
     */
    protected static string $defaultFormat = 'Y-m-d H:i:s';

    /**
     * Resolve the class as a string and return the date in default format.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->format(static::$defaultFormat);
    }

    /**
     * Set the default date format.
     *
     * @param string $format
     *
     * @return string
     */
    public static function setDefaultFormat(string $format): string
    {
        return static::$defaultFormat = $format;
    }

    /**
     * Get the local date for a given or default format.
     *
     * @param string|null $format
     * @param string|null
     *
     * @return string
     */
    public function formatLocale(?string $format = null, ?string $locale = null): string
    {
        if ($locale !== null) {
            $baseLocale = $this->locale ?? null;
            $this->locale($locale);
        }
        $date = $this->settings(['formatFunction' => 'translatedFormat'])->format($format ?: static::$defaultFormat);

        if (isset($baseLocale)) {
            $this->locale($baseLocale);
        }
        return $date;
    }

    /**
     * Get the UTC date for a given or default format.
     *
     * @param string|null $format
     *
     * @return string|null
     */
    public function utc(?string $format = null): ?string
    {
        try {
            return (new static(null, 'UTC'))
                ->setTimestamp($this->getTimestamp())->format($format ?: static::$defaultFormat);
        } catch (Exception $e) {
            return null;
        }
    }
}