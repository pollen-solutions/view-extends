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

class AssetViewExtension extends ViewExtension
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
                function (...$args) {
                    return $this->getFunction(...$args);
                }
            );
        }

        if ($viewEngine instanceof TwigViewEngine) {
            $viewEngine->twigEnvironment()->addFunction(
                new TwigFunction(
                    $this->getName(),
                    function (...$args) {
                        return $this->getFunction(...$args);
                    }
                )
            );
        }

        if ($viewEngine instanceof BladeViewEngine) {
            $viewEngine->blade()->directive(
                $this->getName(),
                function ($expression) {
                    /** @var array $args */
                    $args = array_map(
                        function ($arg) {
                            eval('$param=' . trim($arg) . ';');

                            /** @var array $param */
                            return $param;
                        },
                        explode(',', $expression)
                    );

                    return $this->getFunction(...$args);
                }
            );
        }

        return null;
    }

    protected function getFunction(string $name): string
    {
        return $this->asset($name)->getUrl();
    }
}