<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\inflector\inc;

use LaunchpadCore\Tests\Fixtures\inc\boot\inflector\inc\Inflector\Inflected;
use LaunchpadCore\Tests\Fixtures\inc\boot\inflector\inc\Inflector\InflectorInterface;

class Subscriber implements InflectorInterface
{
    /**
     * @var Inflected
     */
    protected $inflected;

    /**
     * @hook hook
     */
    public function hook_callback()
    {
        $this->inflected->method();
    }

    public function inflector_method(Inflected $inflected)
    {
        $this->inflected = $inflected;
    }
}