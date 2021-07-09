<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

use Exception;
use Pollen\Support\ParamsBag;

/**
 * @mixin ParamsBag
 */
interface ParamsBagDelegateTraitInterface extends ParamsBagAwareTraitInterface
{
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
    public function __call(string $method, array $arguments);
}