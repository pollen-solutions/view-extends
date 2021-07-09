<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Field\FieldDriverInterface;
use Pollen\Field\FieldManager;
use Pollen\Field\FieldManagerInterface;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\FieldProxyInterface
 */
trait FieldProxy
{
    /**
     * Field manager instance.
     * @var FieldManagerInterface|null
     */
    private ?FieldManagerInterface $fieldManager = null;

    /**
     * Retrieve the field manager instance|Get field instance if it exists.
     *
     * @param string|null $alias
     * @param mixed $idOrParams
     * @param array|null $params
     *
     * @return FieldManagerInterface|FieldDriverInterface
     */
    public function field(?string $alias = null, $idOrParams = null, ?array $params = null)
    {
        if ($this->fieldManager === null) {
            try {
                $this->fieldManager = FieldManager::getInstance();
            } catch (RuntimeException $e) {
                $this->fieldManager = ProxyResolver::getInstance(
                    FieldManagerInterface::class,
                    FieldManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($alias === null) {
            return $this->fieldManager;
        }

        if ($field = $this->fieldManager->get($alias, $idOrParams, $params)) {
            return $field;
        }

        throw new ProxyInvalidArgumentException(sprintf('Field [%s] is unavailable', $alias));
    }

    /**
     * Set the field manager instance.
     *
     * @param FieldManagerInterface $fieldManager
     *
     * @return void
     */
    public function setFieldManager(FieldManagerInterface $fieldManager): void
    {
        $this->fieldManager = $fieldManager;
    }
}