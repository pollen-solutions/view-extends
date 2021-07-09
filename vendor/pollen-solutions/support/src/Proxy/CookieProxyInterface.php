<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Cookie\CookieInterface;
use Pollen\Cookie\CookieJarInterface;

interface CookieProxyInterface
{
    /**
     * Retrieve the cookie jar instance|Get a cookie instance.
     *
     * @param string|null $alias
     *
     * @return CookieJarInterface|CookieInterface
     */
    public function cookie(?string $alias = null);

    /**
     * Set the CookieJar instance.
     *
     * @param CookieJarInterface $cookieJar
     *
     * @return void
     */
    public function setCookieJar(CookieJarInterface $cookieJar): void;
}