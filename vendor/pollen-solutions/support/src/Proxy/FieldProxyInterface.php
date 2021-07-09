<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Field\FieldDriverInterface;
use Pollen\Field\FieldManagerInterface;

Interface FieldProxyInterface
{
    /**
     * Retrieve the field manager instance|Get field instance if it exists.
     *
     * @param string|null $alias
     * @param mixed $idOrParams
     * @param array|null $params
     *
     * @return FieldManagerInterface|FieldDriverInterface
     */
    public function field(?string $alias = null, $idOrParams = null, ?array $params = null);

    /**
     * Set the field manager instance.
     *
     * @param FieldManagerInterface $fieldManager
     *
     * @return void
     */
    public function setFieldManager(FieldManagerInterface $fieldManager): void;
}