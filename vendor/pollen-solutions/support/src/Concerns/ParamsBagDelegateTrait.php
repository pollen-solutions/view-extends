<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

use Exception;
use BadMethodCallException;
use Pollen\Support\ParamsBag;
use Throwable;

/**
 * @mixin ParamsBag
 */
trait ParamsBagDelegateTrait
{
    use ParamsBagAwareTrait;

    /**
     * Delegate call of a ParamsBag method.
     *
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function __call(string $method, array $arguments)
    {
        try {
            return $this->params()->{$method}(...$arguments);
        } catch(Exception $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new BadMethodCallException(
                sprintf(
                    '[%s] Delegate ParamsBag method call [%s] throws an exception: %s',
                    __CLASS__,
                    $method,
                    $e->getMessage()
                ), 0, $e
            );
        }
    }
}