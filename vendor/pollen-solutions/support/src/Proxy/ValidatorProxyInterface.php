<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Validation\ValidatorInterface;

Interface ValidatorProxyInterface
{
    /**
     * Retrieve the validator instance|Get a validation rule instance if it exists.
     *
     * @param string|null $ruleName.
     * @param array|null $args
     *
     * @return ValidatorInterface
     */
    public function validator(?string $ruleName = null, ...$args): ValidatorInterface;

    /**
     * Set the validator instance.
     *
     * @param ValidatorInterface $validator
     *
     * @return void
     */
    public function setValidator(ValidatorInterface $validator): void;
}