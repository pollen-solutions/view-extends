<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

interface ResourcesAwareTraitInterface
{
    /**
     * Get the absolute path to the resource directory.
     *
     * @param string|null $path
     *
     * @return string
     */
    public function resources(?string $path = null): string;

    /**
     * Set the absolute path to the resource directory.
     *
     * @param string $resourceBaseDir
     *
     * @return void
     */
    public function setResourcesBaseDir(string $resourceBaseDir): void;
}