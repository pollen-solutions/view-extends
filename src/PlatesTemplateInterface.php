<?php

declare(strict_types=1);

namespace Pollen\ViewExtends;

use Pollen\View\Engines\Plates\PlatesTemplateInterface as BasePlatesTemplateInterface;

/**
 * @method string asset(string $name)
 * @method string asset_head()
 * @method string asset_footer()
 * @method string field(string $alias, string|array $idOrParams = null, array|null $params = null)
 * @method string form(?string $name = null)
 * @method string partial(string $alias, string|array $idOrParams = null, array|null $params = null)
 */
interface PlatesTemplateInterface extends BasePlatesTemplateInterface
{
}