<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\files\inc;

class Subscriber
{
    protected $key;

    /**
     * @var Cache
     */
    protected $cache;

    /**
     * @param $key
     */
    public function __construct($key, $cache)
    {
        $this->key = $key;
        $this->cache = $cache;
    }

    /**
     * @hook hook
     */
    public function hook_callback()
    {
        $this->cache->clean();
    }
}