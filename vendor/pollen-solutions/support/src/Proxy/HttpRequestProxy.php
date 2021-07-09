<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Http\Request;
use Pollen\Http\RequestInterface;
use Pollen\Support\ProxyResolver;
use Psr\Http\Message\ServerRequestInterface as PsrRequestInterface;
use Symfony\Component\HttpFoundation\Request as BaseRequest;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\HttpRequestProxyInterface
 */
trait HttpRequestProxy
{
    /**
     * HTTP request instance.
     * @var RequestInterface|null
     */
    private ?RequestInterface $httpRequest = null;

    /**
     * Get the HTTP request instance.
     *
     * @return RequestInterface|BaseRequest
     */
    public function httpRequest(): RequestInterface
    {
        if ($this->httpRequest === null) {
            try {
                $this->httpRequest = ProxyResolver::getInstance(
                    RequestInterface::class,
                    null,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            } catch (RuntimeException $e) {
                $this->httpRequest = Request::createFromGlobals();
            }
        }

        return $this->httpRequest;
    }

    /**
     * Get the PSR-7 HTTP request instance.
     *
     * @return PsrRequestInterface
     */
    public function httpPsrRequest(): PsrRequestInterface
    {
        return $this->httpRequest()->psr();
    }

    /**
     * Set the HTTP request instance.
     *
     * @param RequestInterface $httpRequest
     *
     * @return void
     */
    public function setHttpRequest(RequestInterface $httpRequest): void
    {
        $this->httpRequest = $httpRequest;
    }
}