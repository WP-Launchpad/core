<?php

namespace LaunchpadCore\Tests\Integration\inc\Deactivation\Deactivation\classes;

use LaunchpadCore\Deactivation\DeactivationInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareTrait;

class Deactivator implements DeactivationInterface, DispatcherAwareInterface
{
    use DispatcherAwareTrait;

    protected $called = false;

    /**
     * @inheritDoc
     */
    public function deactivate()
    {
        $this->called = true;
        $this->dispatcher->do_action('deactivate');
    }

    public function isCalled(): bool
    {
        return $this->called;
    }

}