<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

/**
 * @see \Pollen\Support\Concerns\BootableTraitInterface
 */
trait BootableTrait
{
    /**
     * Booting status.
     * @var bool
     */
    private bool $booted = false;

    /**
     * Check if the boot status is enabled.
     *
     * @return bool
     */
    public function isBooted(): bool
    {
        return $this->booted;
    }

    /**
     * Set the boot status.
     *
     * @param bool $booted
     *
     * @return void
     */
    public function setBooted(bool $booted = true): void
    {
        $this->booted = $booted;
    }
}