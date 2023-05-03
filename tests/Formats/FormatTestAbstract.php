<?php

declare(strict_types=1);

namespace RedExplosion\Vermillion\Tests\Formats;

use RedExplosion\Vermillion\Exceptions\BadVersionFormatException;
use RedExplosion\Vermillion\Formats\VersionNormalizer;
use RedExplosion\Vermillion\ApiVersion as ApiVersionAbstract;
use RedExplosion\Vermillion\Tests\TestCase;

abstract class FormatTestAbstract extends TestCase
{
    /**
     * @var VersionNormalizer
     */
    protected VersionNormalizer $normalizer;

    public function setUp(): void
    {
        $this->normalizer = $this->createNormalizer();
    }

    /**
     * @return void
     * @dataProvider dataNormalize
     */
    public function testNormalize($toNormalize, $intValue, $stringValue): void
    {
        $version = $this->normalizer->normalize($toNormalize);
        $this->assertInstanceOf(ApiVersionAbstract::class, $version);
        $this->assertInstanceOf($this->getApiVersionClassName(), $version);
        $this->assertEquals($intValue, $version->toInt());
        $this->assertEquals($stringValue, $version->toString());
        $this->assertTrue($version->eq($toNormalize));
    }

    /**
     * @param $toNormalize
     * @param string|null $exceptionClass
     * @param string|null $exceptionMessage
     * @return void
     * @dataProvider dataNormalizeFails
     */
    public function testNormalizeFails($toNormalize, string $exceptionClass = null, string $exceptionMessage = null): void
    {
        $this->expectException($exceptionClass ?? BadVersionFormatException::class);
        if ($exceptionMessage !== null) {
            $this->expectExceptionMessage($exceptionMessage);
        }
        $this->normalizer->normalize($toNormalize);
    }


    abstract protected function createNormalizer(): VersionNormalizer;

    /**
     * @return class-string
     */
    abstract protected function getApiVersionClassName(): string;

    /**
     * @return iterable
     */
    abstract public function dataNormalize(): iterable;

    /**
     * @return iterable
     */
    abstract public function dataNormalizeFails(): iterable;
}
