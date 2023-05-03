<?php

declare(strict_types=1);

namespace RedExplosion\Vermillion\Tests\VersionedSet;

use RedExplosion\Vermillion\Formats\Numeric\NumericNormalizer;
use RedExplosion\Vermillion\Tests\TestCase;
use RedExplosion\Vermillion\VersionedItem;
use stdClass;

class VersionedItemTest extends TestCase
{
    private NumericNormalizer $normalizer;

    public function setUp(): void
    {
        $this->normalizer = new NumericNormalizer();
    }

    /**
     * @return void
     */
    public function testValue(): void
    {
        $obj = new stdClass();
        $item = new VersionedItem($this->normalizer->normalize('1'), $obj);
        $this->assertSame($obj, $item->getValue());
    }

    /**
     * @return void
     */
    public function testMinVersion(): void
    {
        $obj = new stdClass();
        $item = new VersionedItem($version = $this->normalizer->normalize('1'), $obj);
        $this->assertSame($version, $item->getMinVersion());
    }
}
