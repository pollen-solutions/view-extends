<?php

declare(strict_types=1);

namespace Pollen\Support;

use BadMethodCallException;
use RuntimeException;
use ReflectionClass;
use ReflectionException;
use Throwable;

/**
 * @mixin ReflectionClass
 */
class ClassInfo
{
    /**
     * List of registred reflection classes.
     * @var ReflectionClass[]|array
     */
    protected static array $reflectionClasses = [];

    /**
     * Name of the current class.
     * @var string
     */
    protected string $currentClassName = '';

    /**
     * @param string|object $class
     */
    public function __construct($class)
    {
        $this->currentClassName = is_object($class) ? get_class($class) : $class;

        if (self::$reflectionClasses[$this->currentClassName] ?? null) {
            try {
                self::$reflectionClasses[$this->currentClassName] = new ReflectionClass($this->currentClassName);
            } catch (ReflectionException $e) {
                throw new RuntimeException(
                    sprintf(
                        'ClassInfo unable instanciate ReflectionClass for [%s]',
                        $this->currentClassName
                    ),
                    0,
                    $e
                );
            }
        }
    }

    /**
     * Delegate the method call of current class.
     *
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        try {
            return self::$reflectionClasses[$this->currentClassName]->$method(...$arguments);
        } catch (Throwable $e) {
            throw new BadMethodCallException(
                sprintf(
                    'Default Logger method call [%s] throws an exception: %s',
                    $method,
                    $e->getMessage()
                ), 0, $e
            );
        }
    }

    /**
     * Get the absolute path to the class directory.
     *
     * @return string
     */
    public function getDirname(): string
    {
        return dirname($this->getFilename());
    }

    /**
     * Get the kebab name to the class.
     * {@ internal KebabName is lower case letters separated by dashes format.}
     *
     * @return string
     */
    public function getKebabName(): string
    {
        return Str::kebab($this->getShortName());
    }
}