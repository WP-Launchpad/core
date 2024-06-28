<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\inflector\inc;

use LaunchpadCore\Container\PrefixAware;
use LaunchpadCore\Container\PrefixAwareInterface;
use LaunchpadCore\Deactivation\DeactivationInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareTrait;
use LaunchpadCore\Tests\Fixtures\inc\boot\inflector\inc\Inflector\Inflected;
use LaunchpadCore\Tests\Fixtures\inc\boot\inflector\inc\Inflector\InflectorInterface;

class Deactivator implements DeactivationInterface, PrefixAwareInterface, DispatcherAwareInterface, InflectorInterface
{
    use PrefixAware, DispatcherAwareTrait;

    protected $deactivateDependency;

    /**
     * @var Inflected
     */
    protected $inflected;

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

    public function inflector_method(Inflected $inflected)
    {
        $this->inflected = $inflected;
    }
}