<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Partial\PartialDriverInterface;
use Pollen\Partial\PartialManager;
use Pollen\Partial\PartialManagerInterface;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\PartialProxyInterface
 */
trait PartialProxy
{
    /**
     * Partial manager instance.
     * @var PartialManagerInterface|null
     */
    private ?PartialManagerInterface $partialManager = null;

    /**
     * Retrieve the partial manager instance|Get a partial instance if it exists.
     *
     * @param string|null $alias
     * @param mixed $idOrParams
     * @param array|null $params
     *
     * @return PartialManagerInterface|PartialDriverInterface
     */
    public function partial(?string $alias = null, $idOrParams = null, ?array $params = null)
    {
        if ($this->partialManager === null) {
            try {
                $this->partialManager = PartialManager::getInstance();
            } catch (RuntimeException $e) {
                $this->partialManager = ProxyResolver::getInstance(
                    PartialManagerInterface::class,
                    PartialManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($alias === null) {
            return $this->partialManager;
        }

        if ($partial = $this->partialManager->get($alias, $idOrParams, $params)) {
            return $partial;
        }

        throw new ProxyInvalidArgumentException(sprintf('Partial [%s] is unavailable', $alias));
    }

    /**
     * Set the partial manager instance.
     *
     * @param PartialManagerInterface $partialManager
     *
     * @return void
     */
    public function setPartialManager(PartialManagerInterface $partialManager): void
    {
        $this->partialManager = $partialManager;
    }
}