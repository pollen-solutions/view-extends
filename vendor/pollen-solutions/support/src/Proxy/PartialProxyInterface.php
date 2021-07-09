<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Partial\PartialDriverInterface;
use Pollen\Partial\PartialManagerInterface;

interface PartialProxyInterface
{
    /**
     * Retrieve the partial manager instance|Get a partial instance if it exists.
     *
     * @param string|null $alias
     * @param mixed $idOrParams
     * @param array|null $params
     *
     * @return PartialManagerInterface|PartialDriverInterface
     */
    public function partial(?string $alias = null, $idOrParams = null, ?array $params = null);

    /**
     * Set the partial manager instance.
     *
     * @param PartialManagerInterface $partialManager
     *
     * @return void
     */
    public function setPartialManager(PartialManagerInterface $partialManager): void;
}