<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Session\SessionManager;
use Pollen\Session\SessionManagerInterface;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\SessionProxyInterface
 */
trait SessionProxy
{
    /**
     * Session manager instance.
     * @var SessionManagerInterface|null
     */
    private ?SessionManagerInterface $sessionManager = null;

    /**
     * Get the session manager instance.
     *
     * @return SessionManagerInterface
     */
    public function session(): SessionManagerInterface
    {
        if ($this->sessionManager === null) {
            try {
                $this->sessionManager = SessionManager::getInstance();
            } catch (RuntimeException $e) {
                $this->sessionManager = ProxyResolver::getInstance(
                    SessionManagerInterface::class,
                    SessionManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        return $this->sessionManager;
    }

    /**
     * Set the session manager instance.
     *
     * @param SessionManagerInterface $sessionManager
     *
     * @return void
     */
    public function setSessionManager(SessionManagerInterface $sessionManager): void
    {
        $this->sessionManager = $sessionManager;
    }
}