<?php

namespace Itkg\Core\Cache\Event;

use Itkg\Core\CacheableInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class CacheEvent
 * @package Itkg\Cache\Event
 */
class CacheEvent extends Event
{
    /**
     * @var CacheableInterface
     */
    private $CacheableData;

    /**
     * Constructor
     *
     * @param string $key
     * @param int $ttl
     * @param $value
     */
    public function __construct(CacheableInterface $CacheableData)
    {
        $this->CacheableData = $CacheableData;
    }

    /**
     * @return CacheableInterface
     */
    public function getCacheabledata()
    {
        return $this->CacheableData;
    }
}
