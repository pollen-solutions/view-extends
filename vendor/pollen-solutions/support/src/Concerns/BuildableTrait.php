<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

/**
 * @see \Pollen\Support\Concerns\BuildableTraitInterface
 */
trait BuildableTrait
{
    /**
     * Build status.
     * @var bool
     */
    private bool $built = false;

    /**
     * Check if build status is enabled.
     *
     * @return bool
     */
    public function isBuilt(): bool
    {
        return $this->built;
    }

    /**
     * Set the build status.
     *
     * @param bool $built
     *
     * @return void
     */
    public function setBuilt(bool $built = true): void
    {
        $this->built = $built;
    }
}