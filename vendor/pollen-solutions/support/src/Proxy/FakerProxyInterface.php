<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Faker\FakerInterface;

Interface FakerProxyInterface
{
    /**
     * Get faker instance|Return a modifier call.
     *
     * @param string|null $modifier
     * @param ...$args
     *
     * @return FakerInterface|mixed
     */
    public function faker(?string $modifier = null, ...$args);

    /**
     * Set faker instance.
     *
     * @param FakerInterface $faker
     *
     * @return void
     */
    public function setFaker(FakerInterface $faker): void;
}