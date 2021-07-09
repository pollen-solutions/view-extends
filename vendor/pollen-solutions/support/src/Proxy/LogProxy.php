<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Log\LogManager;
use Pollen\Log\LogManagerInterface;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\LogProxyInterface
 */
trait LogProxy
{
    /**
     * Log manager instance.
     * @var LogManagerInterface|null
     */
    private ?LogManagerInterface $logManager = null;

    /**
     * Retrieve the log manager instance|Add a log record.
     *
     * @param string|int|null $level
     * @param string $message
     * @param array $context
     *
     * @return LogManagerInterface|bool
     */
    public function log($level = null, string $message = '', array $context = [])
    {
        if ($this->logManager === null) {
            try {
                $this->logManager = LogManager::getInstance();
            } catch (RuntimeException $e) {
                $this->logManager = ProxyResolver::getInstance(
                    LogManagerInterface::class,
                    LogManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($level === null) {
            return $this->logManager;
        }

        return $this->logManager->addRecord($level, $message, $context);
    }

    /**
     * Set the log manager instance.
     *
     * @param LogManagerInterface $logManager
     *
     * @return void
     */
    public function setLogManager(LogManagerInterface $logManager): void
    {
        $this->logManager = $logManager;
    }
}