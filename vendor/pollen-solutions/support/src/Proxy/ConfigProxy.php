<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Config\Configurator;
use Pollen\Config\ConfiguratorInterface;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\ConfigProxyInterface
 */
trait ConfigProxy
{
    /**
     * Configurator instance.
     * @var ConfiguratorInterface|null
     */
    private ?ConfiguratorInterface $configurator = null;

    /**
     * Configurator instance|Set configuration attributes|Get a configuration attribute.
     *
     * @param array|string|null $key
     * @param mixed $default
     *
     * @return ConfiguratorInterface|mixed
     */
    public function config(?string $key = null, $default = null)
    {
        if ($this->configurator === null) {
            try {
                $this->configurator = Configurator::getInstance();
            } catch (RuntimeException $e) {
                $this->configurator = ProxyResolver::getInstance(
                    ConfiguratorInterface::class,
                    Configurator::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($key === null) {
            return $this->configurator;
        }

        if (is_string($key)) {
            return $this->configurator->get($key, $default);
        }

        if (is_array($key)) {
            $this->configurator->set($key);

            return $this->configurator;
        }

        throw new ProxyInvalidArgumentException(
            'Config key argument must be a string (Getter)| an array (Setter) | null (Configurator Instance)'
        );
    }

    /**
     * Set the configurator instance.
     *
     * @param ConfiguratorInterface $configurator
     *
     * @return void
     */
    public function setConfigurator(ConfiguratorInterface $configurator): void
    {
        $this->configurator = $configurator;
    }
}