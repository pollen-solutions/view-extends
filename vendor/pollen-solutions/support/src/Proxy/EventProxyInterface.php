<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Event\EventDispatcherInterface;

interface EventProxyInterface
{
    /**
     * Get the event dispatcher instance.
     *
     * @return EventDispatcherInterface
     */
    public function event(): EventDispatcherInterface;

    /**
     * Set the event dispatcher instance.
     *
     * @param EventDispatcherInterface $eventDispatcher
     *
     * @return void
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher): void;
}