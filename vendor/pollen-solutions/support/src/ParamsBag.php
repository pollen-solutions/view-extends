<?php

declare(strict_types=1);

namespace Pollen\Support;

use ArrayIterator;
use Exception;
use Pollen\Support\Exception\JsonException;

class ParamsBag implements ParamsBagInterface
{
    /**
     * List of parameter attributes.
     * @var array
     */
    protected array $attributes = [];

    /**
     * @param array $attrs
     */
    public function __construct(array $attrs = [])
    {
        if (!empty($attrs)) {
            $this->set($attrs);
            $this->parse();
        }
    }

    /**
     * Create a new instance from a list of parameters attributes.
     *
     * @param array $attrs
     *
     * @return static
     */
    public static function createFromAttrs(array $attrs): self
    {
        $paramBag = new static();
        $paramBag->set($attrs);

        return $paramBag;
    }

    /**
     * @inheritDoc
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * @inheritDoc
     */
    public function __set($key, $value): void
    {
        $this->offsetSet($key, $value);
    }

    /**
     * @inheritDoc
     */
    public function __isset($key): bool
    {
        return $this->offsetExists($key);
    }

    /**
     * @inheritDoc
     */
    public function __unset($key): void
    {
        $this->offsetUnset($key);
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $this->attributes;
    }

    /**
     * @inheritDoc
     */
    public function clear(): void
    {
        $this->attributes = [];
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->attributes);
    }

    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function forget($keys): void
    {
        Arr::forget($this->attributes, $keys);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key, $default = null)
    {
        return Arr::get($this->attributes, $key, $default);
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): iterable
    {
        return new ArrayIterator($this->attributes);
    }

    /**
     * @inheritDoc
     */
    public function has(string $key): bool
    {
        return Arr::has($this->attributes, $key);
    }

    /**
     * @inheritDoc
     */
    public function json(int $options = 0): string
    {
        try {
            $json = json_encode($this->all(), $options|JSON_THROW_ON_ERROR);
        } catch (Exception  $e) {
            throw new JsonException($e->getMessage(), $e->getCode(), $e);
        }

        return $json;
    }

    /**
     * @inheritDoc
     */
    public function keys(): array
    {
        return array_keys($this->attributes);
    }


    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool
    {
        return isset($this->attributes[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
    {
        $this->attributes[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset): void
    {
        unset($this->attributes[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function only(array $keys): array
    {
        return Arr::only($this->attributes, $keys);
    }

    /**
     * @inheritDoc
     */
    public function parse(): void
    {
        $this->attributes = array_merge($this->defaults(), $this->attributes);
    }

    /**
     * @inheritDoc
     */
    public function pull(string $key, $default = null)
    {
        return Arr::pull($this->attributes, $key, $default);
    }

    /**
     * @inheritDoc
     */
    public function push(string $key, $value): void
    {
        if (!$this->has($key)) {
            $this->set($key, []);
        }

        $arr = $this->get($key);

        if (is_array($arr)) {
            $arr[] = $value;
            $this->set($key, $arr);
        }
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value = null): void
    {
        $keys = is_array($key) ? $key : [$key => $value];

        array_walk($keys, [$this, 'map']);

        foreach ($keys as $k => $v) {
            Arr::set($this->attributes, $k, $v);
        }
    }
    /**
     * @inheritDoc
     */
    public function unshift($value, string $key): void
    {
        if (!$this->has($key)) {
            $this->set($key, []);
        }

        $arr = $this->get($key);

        if (is_array($arr)) {
            array_unshift($arr, $value);
            $this->set($key, $arr);
        }
    }

    /**
     * @inheritDoc
     */
    public function values(): array
    {
        return array_values($this->attributes);
    }
}