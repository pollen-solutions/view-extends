<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Metabox\MetaboxManagerInterface;

interface MetaboxProxyInterface
{
    /**
     * Get the metabox manager instance.
     *
     * @return MetaboxManagerInterface
     */
    public function metabox(): MetaboxManagerInterface;

    /**
     * Set the metabox manager instance.
     *
     * @param MetaboxManagerInterface $metaboxManager
     *
     * @return void
     */
    public function setMetaboxManager(MetaboxManagerInterface $metaboxManager): void;
}