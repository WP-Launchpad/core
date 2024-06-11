<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\autowiring\inc;

use LaunchpadCore\Activation\ActivationInterface;
use LaunchpadCore\Container\PrefixAware;
use LaunchpadCore\Container\PrefixAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareTrait;

class Activator implements ActivationInterface, PrefixAwareInterface, DispatcherAwareInterface
{
    use PrefixAware, DispatcherAwareTrait;

    protected $activateDependency;

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
        $this->dispatcher->do_action("{$this->prefix}test");
    }
}