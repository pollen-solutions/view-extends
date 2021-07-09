<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Routing\Router;
use Pollen\Routing\RouterInterface;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\RouterProxyInterface
 */
trait RouterProxy
{
    /**
     * Router instance.
     * @var RouterInterface|null
     */
    private ?RouterInterface $router = null;

    /**
     * Get the router instance.
     *
     * @return RouterInterface
     */
    public function router(): RouterInterface
    {
        if ($this->router === null) {
            try {
                $this->router = Router::getInstance();
            } catch (RuntimeException $e) {
                $this->router = ProxyResolver::getInstance(
                    RouterInterface::class,
                    Router::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        return $this->router;
    }

    /**
     * Set the router instance.
     *
     * @param RouterInterface $router
     *
     * @return void
     */
    public function setRouter(RouterInterface $router): void
    {
        $this->router = $router;
    }
}