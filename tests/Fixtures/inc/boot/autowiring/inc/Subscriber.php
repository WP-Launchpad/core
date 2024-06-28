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
     * @param Dependency $dependency
     * @param string $translation_key
     */
    public function __construct(Dependency $dependency, string $translation_key)
    {
        $this->dependency = $dependency;
        $this->translation_key = $translation_key;
    }

    /**
     * @hook hook
     */
    public function hook_callback()
    {

    }
}