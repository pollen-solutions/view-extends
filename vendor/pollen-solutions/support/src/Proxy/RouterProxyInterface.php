<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Routing\RouterInterface;

interface RouterProxyInterface
{
    /**
     * Get the router instance.
     *
     * @return RouterInterface
     */
    public function router(): RouterInterface;

    /**
     * Set the router instance.
     *
     * @param RouterInterface $router
     *
     * @return void
     */
    public function setRouter(RouterInterface $router): void;
}