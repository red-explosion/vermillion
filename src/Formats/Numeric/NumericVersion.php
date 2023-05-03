<?php

declare(strict_types=1);

namespace RedExplosion\Vermillion\Formats\Numeric;

use RedExplosion\Vermillion\ApiVersion;

/**
 * Versioning format where version numbers are straight-up integers. Think, "Major versions only."
 *
 * @package RedExplosion\Vermillion\Formats\Numeric
 */
class NumericVersion extends ApiVersion
{
    public function toInt(): int
    {
        return (int) $this->versionString;
    }
}
