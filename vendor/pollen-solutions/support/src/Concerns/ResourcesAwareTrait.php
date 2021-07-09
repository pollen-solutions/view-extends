<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

use Pollen\Support\Exception\ResourcesUnavailableException;
use Pollen\Support\Filesystem;
use ReflectionClass;
use ReflectionException;

/**
 * @see \Pollen\Support\Concerns\ResourcesAwareTraitInterface
 */
trait ResourcesAwareTrait
{
    /**
     * Relative path to the resource directory.
     * @var string|null
     */
    protected ?string $resourcesBasePath = '../resources';

    /**
     * Absolute path to the resource directory.
     * @var string|null
     */
    protected ?string $resourcesBaseDir = null;

    /**
     * Get the absolute path to the resource directory.
     *
     * @param string|null $path
     *
     * @return string
     */
    public function resources(?string $path = null): string
    {
        if ($this->resourcesBaseDir === null) {
            try {
                $reflector = new ReflectionClass(get_class($this));
                $this->resourcesBaseDir = realpath(
                    dirname($reflector->getFileName()) . Filesystem::DS . $this->resourcesBasePath
                );
            } catch (ReflectionException $e) {
                throw new ResourcesUnavailableException(
                    sprintf('[%s] ressources directory unreachable', static::class),
                    0,
                    $e
                );
            }

            if (!file_exists($this->resourcesBaseDir)) {
                throw new ResourcesUnavailableException(
                    sprintf('[%s] ressources directory unreachable', static::class)
                );
            }
        }

        return $this->resourcesNormalizePath(
            $path === null
                ? $this->resourcesBaseDir
                : $this->resourcesBaseDir . Filesystem::DS . $path
        );
    }

    /**
     * Set the absolute path to the resource directory.
     *
     * @param string $resourceBaseDir
     *
     * @return void
     */
    public function setResourcesBaseDir(string $resourceBaseDir): void
    {
        $this->resourcesBaseDir = $resourceBaseDir;
    }

    /**
     * Resources path normalization.
     *
     * @param string $path
     *
     * @return string
     */
    protected function resourcesNormalizePath(string $path): string
    {
        return Filesystem::normalizePath($path);
    }
}