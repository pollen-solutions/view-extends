<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Log\LogManagerInterface;

interface LogProxyInterface
{
    /**
     * Retrieve the log manager instance|Add a log record.
     *
     * @param string|int|null $level
     * @param string $message
     * @param array $context
     *
     * @return LogManagerInterface|bool
     */
    public function log($level = null, string $message = '', array $context = []);

    /**
     * Set the log manager instance.
     *
     * @param LogManagerInterface $logManager
     *
     * @return void
     */
    public function setLogManager(LogManagerInterface $logManager): void;
}