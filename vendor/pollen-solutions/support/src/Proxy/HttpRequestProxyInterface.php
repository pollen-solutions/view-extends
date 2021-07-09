<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Http\RequestInterface;
use Psr\Http\Message\ServerRequestInterface as PsrRequestInterface;
use Symfony\Component\HttpFoundation\Request as BaseRequest;

interface HttpRequestProxyInterface
{
    /**
     * Get the HTTP request instance.
     *
     * @return RequestInterface|BaseRequest
     */
    public function httpRequest(): RequestInterface;

    /**
     * Get the PSR-7 HTTP request instance.
     *
     * @return PsrRequestInterface
     */
    public function httpPsrRequest(): PsrRequestInterface;

    /**
     * Set the HTTP request instance.
     *
     * @param RequestInterface $httpRequest
     *
     * @return void
     */
    public function setHttpRequest(RequestInterface $httpRequest): void;
}