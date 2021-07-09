<?php

declare(strict_types=1);

namespace Pollen\Support;

use Psr\Container\ContainerInterface as Container;
use Pollen\Support\Exception\ProxyRuntimeException;

class ProxyResolver
{
    /**
     * Dependency injection container instance.
     * @var Container
     */
    protected static Container $proxyContainer;

    /**
     * Set the dependency injection container instance.
     *
     * @param Container $container
     *
     * @return void
     */
    public static function setContainer(Container $container): void
    {
        static::$proxyContainer = $container;
    }

    /**
     * Get an class instance provided by a static proxy.
     *
     * @param string $alias
     * @param string|null $fallbackClassname
     * @param Container|null $container
     *
     * @return object|mixed
     */
    public static function getInstance(
        string $alias,
        ?string $fallbackClassname = null,
        ?Container $container = null
    ): object {
        if ($container === null) {
            $container = static::$proxyContainer;
        }

        if ($container instanceof Container && $container->has($alias)) {
            return $container->get($alias);
        }

        if ($fallbackClassname !== null) {
            return new $fallbackClassname();
        }

        throw new ProxyRuntimeException(sprintf('Static Proxy could not retrieves [%s] instance.', $alias));
    }
}
