<?php

declare(strict_types=1);

namespace Pollen\Support\Exception;

use RuntimeException;

class ProxyRuntimeException extends RuntimeException implements ProxyThrowable
{
}