<?php

declare(strict_types=1);

namespace Pollen\ViewExtends;

use Pollen\Container\BootableServiceProvider;
use Pollen\View\ViewManagerInterface;
use Pollen\ViewExtends\Extensions\FieldViewExtension;
use Pollen\ViewExtends\Extensions\FormViewExtension;
use Pollen\ViewExtends\Extensions\PartialViewExtension;

class ViewExtendsServiceProvider extends BootableServiceProvider
{
    protected $provides = [
        ViewExtendsInterface::class,
        FieldViewExtension::class,
        FormViewExtension::class,
        PartialViewExtension::class
    ];

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        if ($this->getContainer()->has(ViewManagerInterface::class)) {
            $this->getContainer()->get(ViewExtendsInterface::class);
        }
    }

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->getContainer()->share(ViewExtendsInterface::class, function () {
           return new ViewExtends($this->getContainer()->get(ViewManagerInterface::class), $this->getContainer());
        });

        $this->getContainer()->share(FieldViewExtension::class, function () {
            return new FieldViewExtension('field', $this->getContainer());
        });

        $this->getContainer()->share(FormViewExtension::class, function () {
            return new FormViewExtension('form', $this->getContainer());
        });

        $this->getContainer()->share(PartialViewExtension::class, function () {
            return new PartialViewExtension('partial', $this->getContainer());
        });
    }
}
