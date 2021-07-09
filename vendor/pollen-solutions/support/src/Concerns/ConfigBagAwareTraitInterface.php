<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

use Pollen\Support\ParamsBag;
use InvalidArgumentException;

interface ConfigBagAwareTraitInterface
{
    /**
     * List of default configuration attributes.
     *
     * @return array
     */
    public function defaultConfig(): array;

    /**
     * Instance of ConfigBag|Set a list of configuration attributes|Get a configuration attribute value.
     *
     * @param array|string|null $key
     * @param mixed $default
     *
     * @return string|int|array|mixed|ParamsBag
     *
     * @throws InvalidArgumentException
     */
    public function config($key = null, $default = null);

    /**
     * Parse the entire list of configuration attributes.
     *
     * @return void
     */
    public function parseConfig(): void;

    /**
     * Set a list of configuration attributes.
     *
     * @param array $configAttrs
     *
     * @return void
     */
    public function setConfig(array $configAttrs): void;
}