<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Kernel\Application;
use Pollen\Kernel\ApplicationInterface;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\AppProxyInterface
 */
trait AppProxy
{
    /**
     * Kernel application instance.
     * @var \Pollen\Kernel\ApplicationInterface|null
     */
    private ?ApplicationInterface $app = null;

    /**
     * Resolve Kernel application instance|Service served by the Kernel application.
     *
     * @param string|null $serviceName
     *
     * @return ApplicationInterface|mixed
     */
    public function app(?string $serviceName = null)
    {
        if ($this->app === null) {
            try {
                $this->app = Application::getInstance();
            } catch (RuntimeException $e) {
                $this->app = ProxyResolver::getInstance(
                    ApplicationInterface::class,
                    Application::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($serviceName === null) {
            return $this->app;
        }

        if ($service = $this->app->get($serviceName)) {
            return $service;
        }

        throw new ProxyInvalidArgumentException(sprintf('App service [%s] not provided', $serviceName));
    }

    /**
     * Set Kernel application instance.
     *
     * @param ApplicationInterface $app
     *
     * @return void
     */
    public function setApp(ApplicationInterface $app): void
    {
        $this->app = $app;
    }
}