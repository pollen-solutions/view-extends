<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Encryption\Encrypter;
use Pollen\Encryption\EncrypterInterface;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\EncrypterProxyInterface
 */
trait EncrypterProxy
{
    /**
     * Encrypter instance.
     * @var EncrypterInterface|null
     */
    private ?EncrypterInterface $encrypter = null;

    /**
     * Get the encrypter instance.
     *
     * @return EncrypterInterface
     */
    public function encrypter(): EncrypterInterface
    {
        if ($this->encrypter === null) {
            try {
                $this->encrypter = Encrypter::getInstance();
            } catch (RuntimeException $e) {
                $this->encrypter = ProxyResolver::getInstance(
                    EncrypterInterface::class,
                    null,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        return $this->encrypter;
    }

    /**
     * Decrypt an hashed character string.
     *
     * @param string $hash
     *
     * @return string
     */
    public function decrypt(string $hash): string
    {
        return $this->encrypter()->decrypt($hash);
    }

    /**
     * Encrypt character string.
     *
     * @param string $plain
     *
     * @return string
     */
    public function encrypt(string $plain): string
    {
        return $this->encrypter()->encrypt($plain);
    }

    /**
     * Set the encrypter instance.
     *
     * @param EncrypterInterface $encrypter
     *
     * @return void
     */
    public function setEncrypter(EncrypterInterface $encrypter): void
    {
        $this->encrypter = $encrypter;
    }
}