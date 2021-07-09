<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Console\Console;
use Pollen\Console\ConsoleInterface;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\ConsoleProxyInterface
 */
trait ConsoleProxy
{
    /**
     * Console manager instance.
     * @var ConsoleInterface|null
     */
    private ?ConsoleInterface $console = null;

    /**
     * Get console manager instance.
     *
     * @return ConsoleInterface
     */
    public function console(): ConsoleInterface
    {
        if ($this->console === null) {
            try {
                $this->console = Console::getInstance();
            } catch (RuntimeException $e) {
                $this->console = ProxyResolver::getInstance(
                    ConsoleInterface::class,
                    Console::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        return $this->console;
    }

    /**
     * Set console manager instance.
     *
     * @param ConsoleInterface $console
     *
     * @return void
     */
    public function setConsole(ConsoleInterface $console): void
    {
        $this->console = $console;
    }
}