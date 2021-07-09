<?php

declare(strict_types=1);

namespace Pollen\Validation;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validatable;

/**
 * @method static ValidatorInterface password(array $args = [])
 * @method static ValidatorInterface serialized(bool $strict = true)
 *
 * @mixin Validatable
 */
interface ValidatorInterface
{
    /**
     * Creates a new Validator instance with a rule that was called on the static method.
     *
     * @param string $ruleName
     * @param array $arguments
     *
     * @return static
     *
     * @throws ComponentException
     */
    public static function __callStatic(string $ruleName, array $arguments): ValidatorInterface;

    /**
     * Create a new rule by the name of the method and adds the rule to the chain.
     *
     * @param string $ruleName
     * @param mixed[] $arguments
     *
     * @return static
     *
     * @throws ComponentException
     */
    public function __call(string $ruleName, array $arguments): ValidatorInterface;

    /**
     * Get main instance or create a new instance.
     *
     * @return static
     */
    public static function createOrExisting(): ValidatorInterface;

    /**
     * Set a custom validation rule.
     *
     * @param string $name
     * @param Validatable $rule
     *
     * @return static
     */
    public function setCustomRule(string $name, Validatable $rule): ValidatorInterface;
}