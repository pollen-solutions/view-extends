<?php

declare(strict_types=1);

namespace Pollen\Support;

use Composer\Autoload\ClassLoader as BaseClassLoader;
use Pollen\Support\Filesystem as fs;
use RuntimeException;

/**
 * @deprecated
 * @internal It is better to use composer.
 */
class ClassLoader extends BaseClassLoader
{
    /**
     * Absolute path to the file directory.
     * @var string
     */
    protected static string $baseDir = '';

    /**
     * Set PSR-0 or PSR-4 classe namespace|Include a file.
     *
     * @param string $prefix
     * @param array|string $paths
     * @param string $type psr-4|psr-0|files
     *
     * @return $this
     */
    public function load(string $prefix, $paths, string $type = 'psr-4'): self
    {
        switch ($type) {
            default :
            case 'psr-4' :
                $this->addPsr4($prefix, $paths);
                break;
            case 'psr-0' :
                $this->add($prefix, $paths);
                break;
            case 'files' :
                if (is_string($paths)) {
                    $paths = Arr::wrap($paths);
                }

                foreach ($paths as $path) {
                    $file = fs::normalizePath(self::$baseDir . fs::DS . $path);

                    if (file_exists($file)) {
                        include_once $file;
                    } else {
                        throw new RuntimeException(
                            sprintf('ClassLoader could not require file [%s]', $file)
                        );
                    }
                }
                break;
            case 'classmap' :
                /** @todo */
                break;
        }

        $this->register();

        return $this;
    }

    /**
     * Set absolute path to the file directory.
     * @param $baseDir
     */
    public static function setBaseDir($baseDir): void
    {
        self::$baseDir = $baseDir;
    }
}