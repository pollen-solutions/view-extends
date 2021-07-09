<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

use Pollen\Support\ParamsBag;
use InvalidArgumentException;

interface ParamsBagAwareTraitInterface
{
    /**
     * List of default parameters.
     *
     * @return array
     */
    public function defaultParams(): array;

    /**
     * Instance of ParamsBag|Set a list of parameters|Get a parameters value.
     *
     * @param array|string|null $key
     * @param mixed $default
     *
     * @return string|int|array|mixed|ParamsBag
     *
     * @throws InvalidArgumentException
     */
    public function params($key = null, $default = null);

    /**
     * Parse the entire list of parameters.
     *
     * @return void
     */
    public function parseParams(): void;

    /**
     * Set a list of parameters.
     *
     * @param array $parameters
     *
     * @return void
     */
    public function setParams(array $parameters): void;
}