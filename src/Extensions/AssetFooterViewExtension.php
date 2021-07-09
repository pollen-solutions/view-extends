<?php

declare(strict_types=1);

namespace Pollen\ViewExtends\Extensions;

use Pollen\Support\Proxy\AssetProxy;
use Pollen\View\Engines\Plates\PlatesViewEngine;
use Pollen\View\Engines\Twig\TwigViewEngine;
use Pollen\View\ViewEngineInterface;
use Pollen\View\ViewExtension;
use Pollen\ViewBlade\BladeViewEngine;
use Twig\TwigFunction;

class AssetFooterViewExtension extends ViewExtension
{
    use AssetProxy;

    /**
     * @inheritDoc
     */
    public function register(ViewEngineInterface $viewEngine)
    {
        if ($viewEngine instanceof PlatesViewEngine) {
            $viewEngine->platesEngine()->registerFunction(
                $this->getName(),
                function () {
                    return $this->getFunction();
                }
            );
        }

        if ($viewEngine instanceof TwigViewEngine) {
            $viewEngine->twigEnvironment()->addFunction(
                new TwigFunction(
                    $this->getName(),
                    function () {
                        return $this->getFunction();
                    },
                    [
                        'is_safe' => ['html'],
                    ]
                )
            );
        }

        if ($viewEngine instanceof BladeViewEngine) {
            $viewEngine->blade()->directive(
                $this->getName(),
                function () {
                    return $this->getFunction();
                }
            );
        }

        return null;
    }

    protected function getFunction(): string
    {
        return $this->asset()->getFooter();
    }
}