<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Asset\AssetInterface;
use Pollen\Asset\AssetManagerInterface;

Interface AssetProxyInterface
{
    /**
     * Returns the asset manager instance|A registered asset instance.
     *
     * @param string|null $name
     *
     * @return AssetManagerInterface|AssetInterface
     */
    public function asset(?string $name = null);

    /**
     * Set the asset manager instance.
     *
     * @param AssetManagerInterface $assetManager
     *
     * @return void
     */
    public function setAssetManager(AssetManagerInterface $assetManager): void;
}