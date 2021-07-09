<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

use Pollen\Support\ParamsBag;
use InvalidArgumentException;

trait ParamsBagAwareTrait
{
    /**
     * ParamsBag instance.
     * @var ParamsBag|null
     */
    private ?ParamsBag $paramsBag = null;

    /**
     * List of default parameters.
     *
     * @return array
     */
    public function defaultParams(): array
    {
        return [];
    }

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
    public function params($key = null, $default = null)
    {
        if (!$this->paramsBag instanceof ParamsBag) {
            $this->paramsBag = ParamsBag::createFromAttrs($this->defaultParams());
        }

        if (is_null($key)) {
            return $this->paramsBag;
        }

        if (is_string($key)) {
            return $this->paramsBag->get($key, $default);
        }

        if (is_array($key)) {
            $this->paramsBag->set($key);
            return $this->paramsBag;
        }

        throw new InvalidArgumentException('Invalid ParamsBag passed method arguments');
    }

    /**
     * Parse the entire list of parameters.
     *
     * @return void
     */
    public function parseParams(): void {}

    /**
     * Set a list of parameters.
     *
     * @param array $parameters
     *
     * @return void
     */
    public function setParams(array $parameters): void
    {
        $this->params($parameters);
    }
}