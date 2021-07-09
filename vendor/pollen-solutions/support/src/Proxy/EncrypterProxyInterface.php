<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Encryption\EncrypterInterface;

interface EncrypterProxyInterface
{
    /**
     * Get the encrypter instance.
     *
     * @return EncrypterInterface
     */
    public function encrypter(): EncrypterInterface;

    /**
     * Decrypt an hashed character string.
     *
     * @param string $hash
     *
     * @return string
     */
    public function decrypt(string $hash): string;

    /**
     * Encrypt character string.
     *
     * @param string $plain
     *
     * @return string
     */
    public function encrypt(string $plain): string;

    /**
     * Set the encrypter instance.
     *
     * @param EncrypterInterface $encrypter
     *
     * @return void
     */
    public function setEncrypter(EncrypterInterface $encrypter): void;
}