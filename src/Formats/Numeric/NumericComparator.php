<?php

declare(strict_types=1);

namespace RedExplosion\Vermillion\Formats\Numeric;

use RedExplosion\Vermillion\ApiVersion as BaseApiVersion;
use RedExplosion\Vermillion\Exceptions\VersioningException;
use RedExplosion\Vermillion\Formats\VersionComparator;

class NumericComparator implements VersionComparator
{
    /**
     * @param BaseApiVersion $version1
     * @param BaseApiVersion $version2
     * @return int
     */
    public function compare(BaseApiVersion $version1, BaseApiVersion $version2): int
    {
        if (!$version1 instanceof NumericVersion) {
            throw new VersioningException(sprintf(
                'Expected $version1 to be instance of %s. Got %s',
                NumericVersion::class,
                get_class($version1),
            ));
        }

        if (!$version2 instanceof NumericVersion) {
            throw new VersioningException(sprintf(
                'Expected $version1 to be instance of %s. Got %s',
                NumericVersion::class,
                get_class($version2),
            ));
        }

        return $version1->toInt() <=> $version2->toInt();
    }
}
