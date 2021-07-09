<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Config\ConfiguratorInterface;

interface ConfigProxyInterface
{
    /**
     * Configurator instance|Set configuration attributes|Get a configuration attribute.
     *
     * @param array|string|null $key
     * @param mixed $default
     *
     * @return ConfiguratorInterface|mixed
     */
    public function config(?string $key = null, $default = null);

    /**
     * Set the configurator instance.
     *
     * @param ConfiguratorInterface $configurator
     *
     * @return void
     */
    public function setConfigurator(ConfiguratorInterface $configurator): void;
}