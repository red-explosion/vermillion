<?php

declare(strict_types=1);

namespace RedExplosion\Vermillion\Tests\Formats\Numeric;

use RedExplosion\Vermillion\Formats\Numeric\NumericVersion;
use RedExplosion\Vermillion\Formats\Numeric\NumericNormalizer;
use RedExplosion\Vermillion\Tests\Formats\FormatTestAbstract;
use RedExplosion\Vermillion\Formats\VersionNormalizer;

class ApiVersionTest extends FormatTestAbstract
{
    protected static function createNormalizer(): VersionNormalizer
    {
        return new NumericNormalizer();
    }

    protected function getApiVersionClassName(): string
    {
        return NumericVersion::class;
    }

    /**
     * @return iterable
     */
    public static function dataNormalize(): iterable
    {
        yield [
            '1',
            1,
            '1',
        ];

        yield [
            '2',
            2,
            '2',
        ];

        yield [
            '10',
            10,
            '10',
        ];

        yield [
            (string) PHP_INT_MAX,
            PHP_INT_MAX,
            (string) PHP_INT_MAX,
        ];
    }

    public static function dataNormalizeFails(): iterable
    {
        yield 'negative number: -1' => [
            '-1',
        ];

        yield 'float: 2.5' => [
            '2.5',
        ];

        yield 'float: 2.0' => [
            '2.0',
        ];

        yield 'semver: 0.0.1' => [
            '0.0.1',
        ];

        yield 'semver: 1.0.0' => [
            '1.0.0',
        ];
    }

}
