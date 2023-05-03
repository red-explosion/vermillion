<?php

declare(strict_types=1);

namespace RedExplosion\Vermillion\Formats\Date;

use RedExplosion\Vermillion\ApiVersion;
use RedExplosion\Vermillion\Exceptions\VersioningException;
use RedExplosion\Vermillion\Formats\VersionComparator;

class DateComparator implements VersionComparator
{
    public function compare(ApiVersion $version1, ApiVersion $version2): int
    {
        if (!$version1 instanceof DateVersion) {
            throw new VersioningException(sprintf(
                'Expected $version1 to be instance of %s. Got %s',
                DateVersion::class,
                get_class($version1),
            ));
        }
        if (!$version2 instanceof DateVersion) {
            throw new VersioningException(sprintf(
                'Expected $version1 to be instance of %s. Got %s',
                DateVersion::class,
                get_class($version2),
            ));
        }

        return $version1 <=> $version2;
    }
}
