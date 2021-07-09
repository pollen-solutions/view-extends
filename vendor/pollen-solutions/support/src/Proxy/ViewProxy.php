<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Support\ProxyResolver;
use Pollen\View\ViewInterface;
use Pollen\View\ViewManager;
use Pollen\View\ViewManagerInterface;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\ViewProxyInterface
 */
trait ViewProxy
{
    /**
     * ViewManager instance.
     * @var ViewManagerInterface|null
     */
    private ?ViewManagerInterface $viewManager = null;

    /**
     * Retrieve viewManager instance.
     *
     * @return ViewManagerInterface
     */
    public function viewManager(): ViewManagerInterface
    {
        if ($this->viewManager === null) {
            try {
                $this->viewManager = ViewManager::getInstance();
            } catch (RuntimeException $e) {
                $this->viewManager = ProxyResolver::getInstance(
                    ViewManagerInterface::class,
                    ViewManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        return $this->viewManager;
    }

    /**
     * Retrieve view engine instance|Return the named template render if it exists.
     *
     * @param string|null $name.
     * @param array $data
     *
     * @return ViewInterface|string
     */
    public function view(?string $name = null, array $data = [])
    {
        $view = $this->viewManager()->getDefaultView();

        if ($name === null) {
            return $view;
        }

        return $view ->render($name, $data);
    }

    /**
     * Set view manager instance.
     *
     * @param ViewManagerInterface $viewManager
     *
     * @return void
     */
    public function setViewManager(ViewManagerInterface $viewManager): void
    {
        $this->viewManager = $viewManager;
    }
}