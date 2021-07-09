<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Asset\AssetInterface;
use Pollen\Asset\AssetManager;
use Pollen\Asset\AssetManagerInterface;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\AssetProxyInterface
 */
trait AssetProxy
{
    /**
     * Asset Manager instance.
     * @var AssetManagerInterface|null
     */
    private ?AssetManagerInterface $assetManager = null;

    /**
     * Returns the asset manager instance|A registered asset instance.
     *
     * @param string|null $name
     *
     * @return AssetManagerInterface|AssetInterface
     */
    public function asset(?string $name = null)
    {
        if ($this->assetManager === null) {
            try {
                $this->assetManager = AssetManager::getInstance();
            } catch (RuntimeException $e) {
                $this->assetManager = ProxyResolver::getInstance(
                    AssetManagerInterface::class,
                    AssetManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($name === null) {
            return $this->assetManager;
        }

        if ($asset = $this->assetManager->get($name)) {
            return $asset;
        }

        throw new ProxyInvalidArgumentException(sprintf('Asset [%s] is unavailable', $asset));
    }

    /**
     * Set the asset manager instance.
     *
     * @param AssetManagerInterface $assetManager
     *
     * @return void
     */
    public function setAssetManager(AssetManagerInterface $assetManager): void
    {
        $this->assetManager = $assetManager;
    }
}