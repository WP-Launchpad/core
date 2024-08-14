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

    protected $key;

    /**
     * @var Cache
     */
    protected $cache;

    public function __construct(DeactivateDependency $deactivateDependency, $key, $cache)
    {
        $this->deactivateDependency = $deactivateDependency;
        $this->key = $key;
        $this->cache = $cache;
    }

    /**
     * @inheritDoc
     */
    public function deactivate()
    {
        delete_option('demo_option');
        $this->dispatcher->do_action("{$this->prefix}test");
        $this->cache->clean();
    }
}