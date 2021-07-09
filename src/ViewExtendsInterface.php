<?php

declare(strict_types=1);

namespace Pollen\ViewExtends;

use Pollen\Support\Concerns\BootableTraitInterface;
use Pollen\Support\Proxy\ContainerProxyInterface;
use Pollen\Support\Proxy\ViewProxyInterface;

interface ViewExtendsInterface extends
    BootableTraitInterface,
    ContainerProxyInterface,
    ViewProxyInterface
{
    /**
     * Booting.
     *
     * @return void
     */
    public function boot(): void;
}