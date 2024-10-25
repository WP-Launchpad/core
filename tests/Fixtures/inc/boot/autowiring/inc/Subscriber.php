<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\autowiring\inc;

class Subscriber
{
    /**
     * @var Dependency
     */
    protected $dependency;

    /**
     * @var string
     */
    protected $translation_key;

    /**
     * @var Cache
     */
    protected $cache;

    protected $key_param;

    /**
     * @param Dependency $dependency
     * @param string $translation_key
     */
    public function __construct(Dependency $dependency, string $translation_key, $cache, $key_param)
    {
        $this->dependency = $dependency;
        $this->translation_key = $translation_key;
        $this->cache = $cache;
        $this->key_param = $key_param;
    }

    /**
     * @hook hook
     */
    public function hook_callback()
    {
        $this->cache->clean();
    }
}