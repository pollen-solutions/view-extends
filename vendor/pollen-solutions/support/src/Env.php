<?php

declare(strict_types=1);

namespace Pollen\Support;

use Dotenv\Dotenv;
use Illuminate\Support\Env as BaseEnv;

class Env extends BaseEnv
{
    /**
     * Environment loader instance.
     * @var Dotenv|null
     */
    protected static ?Dotenv $loader = null;

    /**
     * @param string $dir
     *
     * @return Dotenv
     */
    public static function load(string $dir): Dotenv
    {
        if (static::$loader === null) {
            static::$loader = Dotenv::createImmutable($dir);
            static::$loader->safeLoad();
        }

        return static::$loader;
    }

    /**
     * Checks if the execution environment is the development one.
     *
     * @return bool
     */
    public static function inDev(): bool
    {
        return static::get('APP_ENV') === 'dev' || static::get('APP_ENV') === 'developpement';
    }

    /**
     * Checks if the execution environment is the production one.
     *
     * @return bool
     */
    public static function inProd(): bool
    {
        return static::get('APP_ENV') === 'prod' || static::get('APP_ENV') === 'production';
    }

    /**
     * Checks if the execution environment is the staging one.
     *
     * @return bool
     */
    public static function inStaging(): bool
    {
        return static::get('APP_ENV') === 'staging';
    }
}