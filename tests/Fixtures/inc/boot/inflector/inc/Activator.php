<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\inflector\inc;

use LaunchpadCore\Activation\ActivationInterface;
use LaunchpadCore\Container\PrefixAware;
use LaunchpadCore\Container\PrefixAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareTrait;
use LaunchpadCore\Tests\Fixtures\inc\boot\inflector\inc\Inflector\Inflected;
use LaunchpadCore\Tests\Fixtures\inc\boot\inflector\inc\Inflector\InflectorInterface;

class Activator implements ActivationInterface, PrefixAwareInterface, DispatcherAwareInterface, InflectorInterface
{
    use PrefixAware, DispatcherAwareTrait;

    protected $activateDependency;

    /**
     * @var Inflected
     */
    protected $inflected;

    public function __construct(ActivateDependency $activateDependency)
    {
        $this->activateDependency = $activateDependency;
    }


    /**
     * @inheritDoc
     */
    public function activate()
    {
        update_option('demo_option', true);
        $this->inflected->method();
        $this->dispatcher->do_action("{$this->prefix}test");
    }

    public function inflector_method(Inflected $inflected)
    {
        $this->inflected = $inflected;
    }
}