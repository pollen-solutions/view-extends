<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Debug\DebugManagerInterface;

interface DebugProxyInterface
{
    /**
     * Get debug manager instance.
     *
     * @return DebugManagerInterface
     */
    public function debug(): DebugManagerInterface;

    /**
     * Set debug manager instance.
     *
     * @param DebugManagerInterface $debugManager
     *
     * @return void
     */
    public function setDebugManager(DebugManagerInterface $debugManager): void;
}