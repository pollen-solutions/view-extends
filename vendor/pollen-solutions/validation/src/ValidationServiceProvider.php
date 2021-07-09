<?php

declare(strict_types=1);

namespace Pollen\Validation;

use Pollen\Container\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    protected $provides = [
        ValidatorInterface::class
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->getContainer()->share(ValidatorInterface::class, function () {
            return new Validator();
        });
    }
}