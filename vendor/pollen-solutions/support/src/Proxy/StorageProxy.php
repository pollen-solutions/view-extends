<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Filesystem\FilesystemInterface;
use Pollen\Filesystem\StorageManager;
use Pollen\Filesystem\StorageManagerInterface;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\StorageProxyInterface
 */
trait StorageProxy
{
    /**
     * Storage manager instance.
     * @var StorageManagerInterface|null
     */
    private ?StorageManagerInterface $storageManager = null;

    /**
     * Retrieve the storage manager instance|Get a filesystem instance if it exists.
     *
     * @param string|null $diskName
     *
     * @return StorageManagerInterface|FilesystemInterface
     */
    public function storage(?string $diskName = null)
    {
        if ($this->storageManager === null) {
            try {
                $this->storageManager = StorageManager::getInstance();
            } catch (RuntimeException $e) {
                $this->storageManager = ProxyResolver::getInstance(
                    StorageManagerInterface::class,
                    StorageManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($diskName === null) {
            return $this->storageManager;
        }

        if ($disk = $this->storageManager->disk($diskName)) {
            return $disk;
        }

        throw new ProxyInvalidArgumentException(sprintf('Filesystem [%s] is unavailable', $diskName));
    }

    /**
     * Set the storage manager instance.
     *
     * @param StorageManagerInterface $storageManager
     *
     * @return void
     */
    public function setStorageManager(StorageManagerInterface $storageManager): void
    {
        $this->storageManager = $storageManager;
    }
}