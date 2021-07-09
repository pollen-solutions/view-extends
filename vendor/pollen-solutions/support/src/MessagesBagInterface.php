<?php

declare(strict_types=1);

namespace Pollen\Support;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;

interface MessagesBagInterface extends ArrayAccess, Countable, IteratorAggregate, JsonSerializable
{
    /**
     * List of all records.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Add a new record.
     *
     * @param int $level
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function addRecord(int $level, string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * List of all messages or for a specific level.
     *
     * @param int|null $level
     *
     * @return array
     */
    public function allMessages(?int $level = null): array;

    /**
     * List of all codes or for a specific level.
     *
     * @param int|null $level
     *
     * @return string[]
     */
    public function allCodes(?int $level = null): array;

    /**
     * List of all context datas or for a specific level.
     *
     * @param int|null $level
     *
     * @return array
     */
    public function allContexts(?int $level = null): array;

    /**
     * Get count of records or for a specific level.
     *
     * @param int|null $level
     *
     * @return int
     */
    public function count(?int $level = null): int;

    /**
     * Check if records exists or exists for a specific level.
     *
     * @param int|null $level
     *
     * @return bool
     */
    public function exists(?int $level = null): bool;

    /**
     * Check if records exists for list of context datas or exists for a specific level.
     *
     * @param array $context
     * @param int|null $level
     *
     * @return bool
     */
    public function existsForContext(array $context, ?int $level = null): bool;

    /**
     * Retrieve list of records possibly for a level and/or a code.
     *
     * @param int|null $level
     * @param string|int|null $code
     *
     * @return array
     */
    public function fetch(?int $level = null, $code = null): array;

    /**
     * Retrieve list of records for a list of levels.
     *
     * @param string[]|int[] $levelsMap
     *
     * @return string[][]
     */
    public function fetchMessages(array $levelsMap = []): array;

    /**
     * Reset entire list of records or just for a specific level.
     *
     * @param int|null $level
     *
     * @return static
     */
    public function flush(?int $level = null): MessagesBagInterface;

    /**
     * Get list of records for list of context datas and possibly for a specific level.
     *
     * @param array $context
     * @param int|null $level
     *
     * @return array
     */
    public function getForContext(array $context, ?int $level = null): array;

    /**
     * Get list of codes for a specific level.
     *
     * @param int $level
     *
     * @return string[]|array
     */
    public function getLevelCodes(int $level): array;

    /**
     * Get list of context datas for a specific level and possibly for a specific code.
     *
     * @param int $level
     * @param string|int|null $code
     *
     * @return array
     */
    public function getLevelContexts(int $level, $code = null): array;

    /**
     * Get list of messages for a specific level and possibly for a specific code..
     *
     * @param int $level
     * @param string|int|null $code
     *
     * @return array
     */
    public function getLevelMessages(int $level, $code = null): array;

    /**
     * Check if level exists.
     *
     * @param int $level
     *
     * @return bool
     */
    public function hasLevel(int $level): bool;

    /**
     * Check if level name exists.
     *
     * @param string $levelName
     *
     * @return bool
     */
    public function hasLevelName(string $levelName): bool;

    /**
     * Check if level is handled.
     *
     * @param int $level
     *
     * @return bool
     */
    public function isHandling(int $level): bool;

    /**
     * Get list of records in JSON format.
     *
     * @return string
     */
    public function json(): string;

    /**
     * Set level handling.
     *
     * @param int $level
     *
     * @return static
     */
    public function setHandlingLevel(int $level): MessagesBagInterface;

    /**
     * Add an alert message.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function alert(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Add a critical message.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function critical(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Add a debug message.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function debug(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Add an emergency message.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function emergency(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Add an erro message.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function error(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Add an information message.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function info(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Adds a message at an arbitrary level.
     *
     * @param string|int $level
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function log($level, string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Add a notice message.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function notice(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Ajout a success message.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function success(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Add a warning message.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function warning(string $message = '', ?array $context = null, ?string $code = null): array;
}