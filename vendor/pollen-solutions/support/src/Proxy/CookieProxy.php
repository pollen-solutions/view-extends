<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Cookie\CookieInterface;
use Pollen\Cookie\CookieJar;
use Pollen\Cookie\CookieJarInterface;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\CookieProxyInterface
 */
trait CookieProxy
{
    /**
     * CookieJar instance.
     * @var CookieJarInterface|null
     */
    private ?CookieJarInterface $cookieJar = null;

    /**
     * Retrieve the cookie jar instance|Get a cookie instance.
     *
     * @param string|null $alias
     *
     * @return CookieJarInterface|CookieInterface
     */
    public function cookie(?string $alias = null)
    {
        if ($this->cookieJar === null) {
            try {
                $this->cookieJar = CookieJar::getInstance();
            } catch (RuntimeException $e) {
                $this->cookieJar = ProxyResolver::getInstance(
                    CookieJarInterface::class,
                    CookieJar::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($alias === null) {
            return $this->cookieJar;
        }

        if ($cookie = $this->cookieJar->get($alias)) {
            return $cookie;
        }

        throw new ProxyInvalidArgumentException(sprintf('Cookie [%s] is unavailable', $alias));
    }

    /**
     * Set the CookieJar instance.
     *
     * @param CookieJarInterface $cookieJar
     *
     * @return void
     */
    public function setCookieJar(CookieJarInterface $cookieJar): void
    {
        $this->cookieJar = $cookieJar;
    }
}