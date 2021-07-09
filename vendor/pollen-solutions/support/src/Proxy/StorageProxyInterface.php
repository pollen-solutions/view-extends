<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Filesystem\StorageManagerInterface;
use Pollen\Filesystem\FilesystemInterface;

interface StorageProxyInterface
{
    /**
     * Retrieve the storage manager instance|Get a filesystem instance if it exists.
     *
     * @param string|null $diskName
     *
     * @return StorageManagerInterface|FilesystemInterface
     */
    public function storage(?string $diskName = null);

    /**
     * Set the storage manager instance.
     *
     * @param StorageManagerInterface $storageManager
     *
     * @return void
     */
    public function setStorageManager(StorageManagerInterface $storageManager): void;
}