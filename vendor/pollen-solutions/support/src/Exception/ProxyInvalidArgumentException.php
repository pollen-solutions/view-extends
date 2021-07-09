<?php

declare(strict_types=1);

namespace Pollen\Support\Exception;

use InvalidArgumentException;

class ProxyInvalidArgumentException extends InvalidArgumentException implements ProxyThrowable
{
}