<?php

declare(strict_types=1);

namespace Pollen\ViewExtends;

use Pollen\Support\Concerns\BootableTrait;
use Pollen\Support\Proxy\ContainerProxy;
use Pollen\Support\Proxy\ViewProxy;
use Pollen\View\ViewManagerInterface;
use Pollen\ViewExtends\Extensions\AssetFooterViewExtension;
use Pollen\ViewExtends\Extensions\AssetHeadViewExtension;
use Pollen\ViewExtends\Extensions\AssetViewExtension;
use Pollen\ViewExtends\Extensions\FieldViewExtension;
use Pollen\ViewExtends\Extensions\FormViewExtension;
use Pollen\ViewExtends\Extensions\PartialViewExtension;
use Psr\Container\ContainerInterface as Container;

class ViewExtends implements ViewExtendsInterface
{
    use BootableTrait;
    use ContainerProxy;
    use ViewProxy;

    /**
     * @param ViewManagerInterface $viewManager
     * @param Container|null $container
     */
    public function __construct(ViewManagerInterface $viewManager, ?Container $container = null)
    {
        $this->setViewManager($viewManager);

        if ($container !== null) {
            $this->setContainer($container);
        }

        $this->boot();
    }

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        if (!$this->isBooted()) {
            $this->viewManager()->registerExtension('asset', AssetViewExtension::class, true);
            $this->viewManager()->registerExtension('asset_head', AssetHeadViewExtension::class, true);
            $this->viewManager()->registerExtension('asset_footer', AssetFooterViewExtension::class, true);
            $this->viewManager()->registerExtension('field', FieldViewExtension::class, true);
            $this->viewManager()->registerExtension('form', FormViewExtension::class, true);
            $this->viewManager()->registerExtension('partial', PartialViewExtension::class, true);

            $this->setBooted();
        }
    }
}