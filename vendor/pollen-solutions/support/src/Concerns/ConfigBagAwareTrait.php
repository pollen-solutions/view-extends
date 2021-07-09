<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

use Pollen\Support\ParamsBag;
use InvalidArgumentException;

/**
 * @see \Pollen\Support\Concerns\ConfigBagAwareTraitInterface
 */
trait ConfigBagAwareTrait
{
    /**
     * ConfigBag instance.
     * @var ParamsBag|null
     */
    private ?ParamsBag $configBag = null;

    /**
     * List of default configuration attributes.
     *
     * @return array
     */
    public function defaultConfig(): array
    {
        return [];
    }

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
    public function config($key = null, $default = null)
    {
        if (!$this->configBag instanceof ParamsBag) {
            $this->configBag = ParamsBag::createFromAttrs($this->defaultConfig());
        }

        if (is_null($key)) {
            return $this->configBag;
        }

        if (is_string($key)) {
            return $this->configBag->get($key, $default);
        }

        if (is_array($key)) {
            $this->configBag->set($key);

            return $this->configBag;
        }

        throw new InvalidArgumentException('Invalid ConfigBag passed method arguments');
    }

    /**
     * Parse the entire list of configuration attributes.
     *
     * @return void
     */
    public function parseConfig(): void {}

    /**
     * Set a list of configuration attributes.
     *
     * @param array $configAttrs
     *
     * @return void
     */
    public function setConfig(array $configAttrs): void
    {
        $this->config($configAttrs);
    }
}