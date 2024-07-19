<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\autowiring\inc;

use LaunchpadCore\Container\PrefixAware;
use LaunchpadCore\Container\PrefixAwareInterface;
use LaunchpadCore\Deactivation\DeactivationInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareTrait;

class Deactivator implements DeactivationInterface, PrefixAwareInterface, DispatcherAwareInterface
{
    use PrefixAware, DispatcherAwareTrait;

    protected $deactivateDependency;

    /**
     * @var Cache
     */
    protected $cache;

    protected $key_param;

    public function __construct(DeactivateDependency $deactivateDependency, $cache, $key_param)
    {
        $this->deactivateDependency = $deactivateDependency;
        $this->cache = $cache;
        $this->key_param = $key_param;
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