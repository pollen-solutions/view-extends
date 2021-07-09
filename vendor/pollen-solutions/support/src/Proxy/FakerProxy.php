<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Faker\Faker;
use Pollen\Faker\FakerInterface;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use Throwable;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\FakerProxyInterface
 */
trait FakerProxy
{
    /**
     * Faker instance.
     * @var FakerInterface|null
     */
    private ?FakerInterface $faker = null;

    /**
     * Get faker instance|Return a modifier call.
     *
     * @param string|null $modifier
     * @param ...$args
     *
     * @return FakerInterface|mixed
     */
    public function faker(?string $modifier = null, ...$args)
    {
        if ($this->faker === null) {
            try {
                $this->faker = Faker::getInstance();
            } catch (RuntimeException $e) {
                $this->faker = ProxyResolver::getInstance(
                    Faker::class,
                    FakerInterface::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($modifier === null) {
            return $this->faker;
        }

        try {
            return $this->faker->$modifier(...$args);
        } catch(Throwable $e){
            throw new ProxyInvalidArgumentException(sprintf('Faker modifier [%s] is unavailable.', $modifier), 0, $e);
        }
    }

    /**
     * Set faker instance.
     *
     * @param FakerInterface $faker
     *
     * @return void
     */
    public function setFaker(FakerInterface $faker): void
    {
        $this->faker = $faker;
    }
}