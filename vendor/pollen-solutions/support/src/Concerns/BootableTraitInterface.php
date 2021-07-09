<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

interface BootableTraitInterface
{
    /**
     * Check if the boot status is enabled.
     *
     * @return bool
     */
    public function isBooted(): bool;

    /**
     * Set the boot status.
     *
     * @param bool $booted
     *
     * @return void
     */
    public function setBooted(bool $booted = true): void;
}