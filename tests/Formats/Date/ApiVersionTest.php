<?php

declare(strict_types=1);

namespace RedExplosion\Vermillion\Tests\Formats\Date;

use RedExplosion\Vermillion\Formats\Date\DateVersion;
use RedExplosion\Vermillion\Formats\Date\DateNormalizer;
use RedExplosion\Vermillion\Tests\Formats\FormatTestAbstract;
use RedExplosion\Vermillion\Formats\VersionNormalizer;

class ApiVersionTest extends FormatTestAbstract
{
    protected static function createNormalizer(): VersionNormalizer
    {
        return new DateNormalizer();
    }

    protected function getApiVersionClassName(): string
    {
        return DateVersion::class;
    }

    public static function dataNormalize(): iterable
    {
        yield 'Past date: 1990-01-01' => [
            '1990-01-01',
            631152000,
            '1990-01-01',
        ];

        yield 'Future date: 3000-12-31' => [
            '3000-12-31',
            32535129600,
            '3000-12-31',
        ];

        yield 'Parsed as Y-m-d: 1990-01-12' => [
            '1990-01-12',
            632102400,
            '1990-01-12',
        ];

        $v = new DateVersion('2022-01-01', 1640995200, self::createNormalizer());

        yield 'API version object' => [
            $v,
            1640995200,
            '2022-01-01'
        ];

    }

    public static function dataNormalizeFails(): iterable
    {
        yield 'Bad format: Y-d-m: 2022-31-12' => [
            '2022-31-12',
        ];

        yield 'Bad format: d-m: 02-12' => [
            '100-02-12',
        ];
    }

    public function testNormalizingWithTimeDelay(): void
    {
        $normalizer = $this->createNormalizer();

        $v1 = $normalizer->normalize('2022-01-01');
        sleep(1);
        $v2 = $normalizer->normalize('2022-01-01');
        $this->assertTrue($v1->eq($v2));
    }
}
