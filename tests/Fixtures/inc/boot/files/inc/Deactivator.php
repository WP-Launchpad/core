<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\files\inc;

use LaunchpadCore\Container\PrefixAware;
use LaunchpadCore\Container\PrefixAwareInterface;
use LaunchpadCore\Deactivation\DeactivationInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareTrait;

class Deactivator implements DeactivationInterface, PrefixAwareInterface, DispatcherAwareInterface
{
    use PrefixAware, DispatcherAwareTrait;

    protected $deactivateDependency;

    public function __construct(DeactivateDependency $deactivateDependency)
    {
        $this->deactivateDependency = $deactivateDependency;
    }

    /**
     * @inheritDoc
     */
    public function deactivate()
    {
        delete_option('demo_option');
        $this->dispatcher->do_action("{$this->prefix}test");
    }
}