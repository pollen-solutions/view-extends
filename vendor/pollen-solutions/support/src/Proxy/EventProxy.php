<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Event\EventDispatcher;
use Pollen\Event\EventDispatcherInterface;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\EventProxyInterface
 */
trait EventProxy
{
    /**
     * Event dispatcher instance.
     * @var EventDispatcherInterface|null
     */
    private ?EventDispatcherInterface $eventDispatcher = null;

    /**
     * Get the event dispatcher instance.
     *
     * @return EventDispatcherInterface
     */
    public function event(): EventDispatcherInterface
    {
        if ($this->eventDispatcher === null) {
            try {
                $this->eventDispatcher = EventDispatcher::getInstance();
            } catch (RuntimeException $e) {
                $this->eventDispatcher = ProxyResolver::getInstance(
                    EventDispatcherInterface::class,
                    EventDispatcher::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        return $this->eventDispatcher;
    }

    /**
     * Set the event dispatcher instance.
     *
     * @param EventDispatcherInterface $eventDispatcher
     *
     * @return void
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher): void
    {
        $this->eventDispatcher = $eventDispatcher;
    }
}