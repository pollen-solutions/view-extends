<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\View\ViewInterface;
use Pollen\View\ViewManagerInterface;

interface ViewProxyInterface
{
    /**
     * Retrieve viewManager instance.
     *
     * @return ViewManagerInterface
     */
    public function viewManager(): ViewManagerInterface;

    /**
     * Retrieve view engine instance|Return the named template render if it exists.
     *
     * @param string|null $name.
     * @param array $data
     *
     * @return ViewInterface|string
     */
    public function view(?string $name = null, array $data = []);

    /**
     * Set view manager instance.
     *
     * @param ViewManagerInterface $viewManager
     *
     * @return void
     */
    public function setViewManager(ViewManagerInterface $viewManager): void;
}