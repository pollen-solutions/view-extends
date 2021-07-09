<?php

declare(strict_types=1);

namespace Pollen\Support;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use Pollen\Support\Exception\JsonException;

interface ParamsBagInterface extends ArrayAccess, Countable, IteratorAggregate
{
    /**
     * Get an iteration item.
     *
     * @param string|int $key
     *
     * @return mixed
     */
    public function __get($key);

    /**
     * Set an iteration item.
     *
     * @param string|int $key
     * @param mixed $value
     *
     * @return void
     */
    public function __set($key, $value): void;

    /**
     * Check if an iteration item exists.
     *
     * @param string|int $key
     *
     * @return bool
     */
    public function __isset($key): bool;

    /**
     * Unset an iteration item.
     *
     * @param string|int $key
     *
     * @return void
     */
    public function __unset($key): void;

    /**
     * Get complete list of parameter attributes.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Delete complete list of parameter attributes.
     *
     * @return void
     */
    public function clear(): void;

    /**
     * Count the number of list of parameter attributes.
     *
     * @return int
     */
    public function count(): int;

    /**
     * Set the default list of parameter attributes.
     *
     * @return array
     */
    public function defaults(): array;

    /**
     * Remove one or many parameter attributes.
     *
     * @param array|string $keys
     *
     * @return void
     */
    public function forget($keys): void;

    /**
     * Get a parameter attribute value.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * @inheritDoc
     */
    public function getIterator(): iterable;

    /**
     * Check if a parameter attribute exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * Get list of parameter attributes as a JSON string format.
     * @see https://php.net/manual/function.json-encode.php
     *
     * @param int $options
     *
     * @return string
     *
     * @throws JsonException
     */
    public function json(int $options = 0): string;

    /**
     * Get list of parameter attributes keys.
     *
     * @return string[]
     */
    public function keys(): array;

    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool;

    /**
     * @inheritDoc
     */
    public function offsetGet($offset);

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void;

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset): void;

    /**
     * Get a subset of the parameter attributes from a given list of keys.
     *
     * @param string[] $keys
     *
     * @return array
     */
    public function only(array $keys): array;

    /**
     * Parse the entire list of parameters.
     *
     * @return void
     */
    public function parse(): void;

    /**
     * Get a value of a parameter attribute, and remove it.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function pull(string $key, $default = null);

    /**
     * Append a not indexed value in a list of parameter attributes. Create the list if necessary.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function push(string $key, $value): void;

    /**
     * Set one or many parameter attributes.
     *
     * @param string|array $key
     * @param mixed $value
     *
     * @return void
     */
    public function set($key, $value = null): void;

    /**
     * Prepend a not indexed value in a list of parameter attributes. Create the list if necessary.
     *
     * @param mixed $value
     * @param string $key
     *
     * @return void
     */
    public function unshift($value, string $key): void;

    /**
     * Get the list of parameter attributes values.
     *
     * @return array
     */
    public function values(): array;
}