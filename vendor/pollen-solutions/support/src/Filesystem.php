<?php

declare(strict_types=1);

namespace Pollen\Support;

use BadMethodCallException;
use Exception;
use Composer\Util\Filesystem as ComposerFs;
use InvalidArgumentException;
use Pollen\Support\Exception\FilesystemException;
use Symfony\Component\Filesystem\Filesystem as SymfonyFs;
use Symfony\Component\Filesystem\Exception\IOException;
use Traversable;
use Throwable;

/**
 * @method static void appendToFile(string $filename, string|resource $content)
 * @method static void chgrp(string|iterable $files, $group, bool $recursive = false)
 * @method static void chmod(string|iterable $files, int $mode, int $umask = 0000, bool $recursive = false)
 * @method static void chown(string|iterable $files, $user, bool $recursive = false)
 * @method static void copy(string $originFile, string $targetFile, bool $overwriteNewerFiles = false)
 * @method static bool copyThenRemove(string $source, string $target)
 * @method static void dumpFile(string $filename, string $content)
 * @method static bool emptyDirectory(string $dir, bool $ensureDirectoryExists = true)
 * @method static void ensureDirectoryExists(string $directory)
 * @method static bool exists(string|iterable $files)
 * @method static string findShortestPath(string $from, string $to, bool $directories = false)
 * @method static string findShortestPathCode(string $from, string $to, bool $directories = false, bool $staticCode = false)
 * @method static int|false filePutContentsIfModified(string $path, $content)
 * @method static string getPlatform(string $path)
 * @method static void hardlink(string $originFile, string|string[] $targetFiles)
 * @method static bool isAbsolutePath(string $file)
 * @method static bool isDirEmpty(string $dir)
 * @method static bool isJunction(string $junction)
 * @method static bool isLocalPath(string $path)
 * @method static bool isSymlinkedDirectory(string $directory)
 * @method static void junction(string $target, string $junction)
 * @method static string makePathRelative(string $endPath, string $startPath)
 * @method static void mirror(string $originDir, string $targetDir, Traversable $iterator = null, array $options = [])
 * @method static void mkdir(string|iterable $dirs, int $mode = 0777)
 * @method static string normalizePath(string $path)
 * @method static string|null readlink(string $path, bool $canonicalize = false)
 * @method static bool relativeSymlink(string $target, string $link)
 * @method static void remove(string|iterable $files)
 * @method static bool removeDirectory(string $directory)
 * @method static bool removeDirectoryPhp(string $directory)
 * @method static bool removeJunction(string $junction)
 * @method static void rename(string $origin, string $target, bool $overwrite = false)
 * @method static bool rmdir(string $path)
 * @method static void safeCopy(string $source, string $target)
 * @method static int size(string $path)
 * @method static void symlink(string $originDir, string $targetDir, bool $copyOnWindows = false)
 * @method static string tempnam(string $dir, string $prefix, string $suffix = '')
 * @method static string trimTrailingSlash(string $path)
 * @method static void touch($files, int $time = null, int $atime = null)
 * @method static bool unlink(string $path)
 */
class Filesystem
{
    /**
     * System directory separator.
     * @var string
     */
    public const DS = DIRECTORY_SEPARATOR;

    /**
     * Delegate Filesystem instance.
     * @var ComposerFs|object|null
     */
    protected static $delegateFs;

    /**
     * Delegation file system method call.
     *
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     *
     * @throws Exception
     */
    public static function __callStatic(string $method, array $arguments)
    {
        try {
            $delegateFs = static::getDelegateFs();
            return $delegateFs->{$method}(...$arguments);
        } catch (IOException|InvalidArgumentException $e) {
            throw new FilesystemException($e->getMessage(), 0, $e);
        } catch (Throwable $e) {
            try {
                $composerFs = new ComposerFs();
                return $composerFs->{$method}(...$arguments);
            } catch (Exception $e) {
                throw new FilesystemException($e->getMessage(), 0, $e);
            } catch (Throwable $e) {
                throw new BadMethodCallException(
                    sprintf(
                        'Delegate Filesystem method call [%s] throws an exception',
                        $method,
                    ), 0, $e
                );
            }
        }
    }

    /**
     * Get delegate Filesystem instance.
     *
     * @return SymfonyFs|DelegateFilesystemInterface
     */
    protected static function getDelegateFs(): object
    {
        if (is_null(static::$delegateFs)) {
            static::$delegateFs = new SymfonyFs();
        }
        return static::$delegateFs;
    }

    /**
     * Set delegate Filesystem instance.
     *
     * @param DelegateFilesystemInterface $delegateFs
     *
     * @return void
     */
    protected static function setDelegateFs(DelegateFilesystemInterface $delegateFs): void
    {
        static::$delegateFs = $delegateFs;
    }
}