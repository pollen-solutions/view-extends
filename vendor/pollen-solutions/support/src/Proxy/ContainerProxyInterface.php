<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use League\Container\Definition\DefinitionInterface;
use Psr\Container\ContainerInterface as Container;

interface ContainerProxyInterface
{
    /**
     * Add a service provided by the dependency injection container.
     *
     * @param string $alias
     * @param mixed|null $concrete
     * @param bool $share
     *
     * @return DefinitionInterface
     */
    public function containerAdd(string $alias, $concrete = null, bool $share = false): ?DefinitionInterface;

    /**
     * Check if a service provided by the dependency injection container exists.
     *
     * @param string $alias
     *
     * @return bool
     */
    public function containerHas(string $alias): bool;

    /**
     * Get a service provided by the dependency injection container.
     *
     * @param string $alias
     *
     * @return mixed|null
     */
    public function containerGet(string $alias);

    /**
     * Get the dependency injection container instance.
     *
     * @return Container|null
     */
    public function getContainer(): ?Container;

    /**
     * Set the dependency injection container instance.
     *
     * @param Container $container
     *
     * @return void
     */
    public function setContainer(Container $container): void;
}