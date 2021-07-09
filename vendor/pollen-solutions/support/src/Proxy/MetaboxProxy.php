<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Metabox\MetaboxManager;
use Pollen\Metabox\MetaboxManagerInterface;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\MetaboxProxyInterface
 */
trait MetaboxProxy
{
    /**
     * Metabox manager instance.
     * @var MetaboxManagerInterface|null
     */
    private ?MetaboxManagerInterface $metaboxManager = null;

    /**
     * Get the metabox manager instance.
     *
     * @return MetaboxManagerInterface
     */
    public function metabox(): MetaboxManagerInterface
    {
        if ($this->metaboxManager === null) {
            try {
                $this->metaboxManager = MetaboxManager::getInstance();
            } catch (RuntimeException $e) {
                $this->metaboxManager = ProxyResolver::getInstance(
                    MetaboxManagerInterface::class,
                    MetaboxManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        return $this->metaboxManager;
    }

    /**
     * Set the metabox manager instance.
     *
     * @param MetaboxManagerInterface $metaboxManager
     *
     * @return void
     */
    public function setMetaboxManager(MetaboxManagerInterface $metaboxManager): void
    {
        $this->metaboxManager = $metaboxManager;
    }
}