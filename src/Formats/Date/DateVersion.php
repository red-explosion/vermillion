<?php

declare(strict_types=1);

namespace RedExplosion\Vermillion\Formats\Date;

use RedExplosion\Vermillion\ApiVersion;
use RedExplosion\Vermillion\Formats\VersionNormalizer;

/**
 * Class ApiVersion
 *
 * @package RedExplosion\Vermillion\Formats\Date
 */
class DateVersion extends ApiVersion
{
    /**
     * @var int
     */
    private $timestamp;

    /**
     * ApiVersion constructor.
     *
     * @param string            $versionString
     * @param int               $timestamp
     * @param DateNormalizer $normalizer
     */
    public function __construct(string $versionString, int $timestamp, VersionNormalizer $normalizer)
    {
        $this->timestamp = $timestamp;
        parent::__construct($versionString, $normalizer);
    }

    public function toInt(): int
    {
        return $this->timestamp;
    }
}
