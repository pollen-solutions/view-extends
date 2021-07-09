<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Exception;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use Pollen\Validation\Validator;
use Pollen\Validation\ValidatorInterface;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\ValidatorProxyInterface
 */
trait ValidatorProxy
{
    /**
     * Validator instance.
     * @var ValidatorInterface|null
     */
    private ?ValidatorInterface $validator = null;

    /**
     * Retrieve the validator instance|Get a validation rule instance if it exists.
     *
     * @param string|null $ruleName.
     * @param array|null $args
     *
     * @return ValidatorInterface
     */
    public function validator(?string $ruleName = null, ...$args): ValidatorInterface
    {
        if ($this->validator === null) {
            try {
                $this->validator = Validator::createOrExisting();
            } catch (RuntimeException $e) {
                $this->validator = ProxyResolver::getInstance(
                    ValidatorInterface::class,
                    Validator::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($ruleName === null) {
            return $this->validator;
        }

        try {
            return $this->validator->$ruleName(...$args);
        } catch(Exception $e) {
            throw new ProxyInvalidArgumentException(sprintf('Validator Rule [%s] is unavailable', $ruleName));
        }
    }

    /**
     * Set the validator instance.
     *
     * @param ValidatorInterface $validator
     *
     * @return void
     */
    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }
}