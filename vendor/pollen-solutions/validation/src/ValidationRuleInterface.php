<?php

declare(strict_types=1);

namespace Pollen\Validation;

use Respect\Validation\Validatable;

interface ValidationRuleInterface extends Validatable
{
    /**
     * Set the list of passed arguments.
     *
     * @param mixed ...$args
     *
     * @return static
     */
    public function setArgs(...$args): ValidationRuleInterface;
}