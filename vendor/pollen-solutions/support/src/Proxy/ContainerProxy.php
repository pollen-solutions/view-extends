<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use League\Container\Definition\DefinitionInterface;
use Psr\Container\ContainerInterface as Container;

/**
 * @see \Pollen\Support\Proxy\ContainerProxy
 */
trait ContainerProxy
{
    /**
     * Dependency injection container instance.
     * @var Container|null
     */
    private ?Container $container = null;

    /**
     * Add a service provided by the dependency injection container.
     *
     * @param string $alias
     * @param mixed|null $concrete
     * @param bool $share
     *
     * @return DefinitionInterface
     */
    public function containerAdd(string $alias, $concrete = null, bool $share = false): ?DefinitionInterface
    {
        if($this->getContainer()) {
            return $this->getContainer()->add($alias);
        }
        return null;
    }

    /**
     * Check if a service provided by the dependency injection container exists.
     *
     * @param string $alias
     *
     * @return bool
     */
    public function containerHas(string $alias): bool
    {
        return $this->getContainer() && $this->getContainer()->has($alias);
    }

    /**
     * Get a service provided by the dependency injection container.
     *
     * @param string $alias
     *
     * @return mixed|null
     */
    public function containerGet(string $alias)
    {
        return $this->getContainer() ? $this->getContainer()->get($alias) : null;
    }

    /**
     * Get the dependency injection container instance.
     *
     * @return Container|null
     */
    public function getContainer(): ?Container
    {
        return $this->container;
    }

    /**
     * Set the dependency injection container instance.
     *
     * @param Container $container
     *
     * @return void
     */
    public function setContainer(Container $container): void
    {
        $this->container = $container;
    }
}