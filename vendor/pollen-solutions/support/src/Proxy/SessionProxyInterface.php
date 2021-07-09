<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Session\SessionManagerInterface;

interface SessionProxyInterface
{
    /**
     * Get the session manager instance.
     *
     * @return SessionManagerInterface
     */
    public function session(): SessionManagerInterface;

    /**
     * Set the session manager instance.
     *
     * @param SessionManagerInterface $sessionManager
     *
     * @return void
     */
    public function setSessionManager(SessionManagerInterface $sessionManager): void;
}