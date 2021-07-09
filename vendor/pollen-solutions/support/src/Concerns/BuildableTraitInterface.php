<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

interface BuildableTraitInterface
{
    /**
     * Check if build status is enabled.
     *
     * @return bool
     */
    public function isBuilt(): bool;

    /**
     * Set the build status.
     *
     * @param bool $built
     *
     * @return void
     */
    public function setBuilt(bool $built = true): void;
}