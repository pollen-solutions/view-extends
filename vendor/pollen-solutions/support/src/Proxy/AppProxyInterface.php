<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Kernel\ApplicationInterface;

Interface AppProxyInterface
{
    /**
     * Resolve Kernel application instance|Service served by the Kernel application.
     *
     * @param string|null $serviceName
     *
     * @return ApplicationInterface|mixed
     */
    public function app(?string $serviceName = null);

    /**
     * Set Kernel application instance.
     *
     * @param ApplicationInterface $app
     *
     * @return void
     */
    public function setApp(ApplicationInterface $app): void;
}