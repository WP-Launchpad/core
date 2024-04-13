<?php

namespace LaunchpadCore\Tests\Integration\inc\Activation\Activation\classes;

use LaunchpadCore\Activation\ActivationInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareTrait;

class Activator implements ActivationInterface, DispatcherAwareInterface
{
    use DispatcherAwareTrait;

    protected $called = false;

    /**
     * @inheritDoc
     */
    public function activate()
    {
        $this->called = true;
        $this->dispatcher->do_action('activate');
    }

    public function isCalled(): bool
    {
        return $this->called;
    }
}