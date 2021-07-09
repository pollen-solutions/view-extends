<?php

declare(strict_types=1);

namespace Pollen\View;

use Pollen\Container\ServiceProvider;
use Pollen\View\Engines\Plates\PlatesViewEngine;
use Pollen\View\Engines\Twig\TwigViewEngine;
use Pollen\View\Extensions\FakerViewExtension;

class ViewServiceProvider extends ServiceProvider
{
    protected $provides = [
        ViewInterface::class,
        ViewManagerInterface::class,
        PlatesViewEngine::class,
        TwigViewEngine::class,
        FakerViewExtension::class
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->getContainer()->share(ViewManagerInterface::class, function () {
            return new ViewManager([], $this->getContainer());
        });

        $this->getContainer()->share(ViewInterface::class, function () {
            /** @var ViewManagerInterface $viewManager */
            $viewManager = $this->getContainer()->get(ViewManagerInterface::class);

            return $viewManager->getDefaultView();
        });

        $this->getContainer()->share(PlatesViewEngine::class, function () {
            return new PlatesViewEngine();
        });

        $this->getContainer()->share(TwigViewEngine::class, function () {
            return new TwigViewEngine();
        });

        $this->getContainer()->share(FakerViewExtension::class, function () {
            return new FakerViewExtension();
        });
    }
}
