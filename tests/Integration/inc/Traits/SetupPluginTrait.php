<?php

namespace LaunchpadCore\Tests\Integration\inc\Traits;

use LaunchpadCore\EventManagement\EventManager;
use LaunchpadCore\EventManagement\Wrapper\SubscriberWrapper;
use LaunchpadCore\Plugin;
use LaunchpadDispatcher\Dispatcher;
use League\Container\Container;

trait SetupPluginTrait
{
    /**
     * @var EventManager
     */
    protected $event_manager;

    protected $container;

    protected $subscriber_wrapper;

    protected $dispatcher;

    protected $plugin;

    protected function setup_plugin(string $prefix, array $providers = [])
    {
        $this->event_manager = new EventManager();
        $this->container = new Container();
        $this->subscriber_wrapper = new SubscriberWrapper($prefix, $this->container);
        $this->dispatcher = new Dispatcher();

        $this->plugin = new Plugin($this->container, $this->event_manager, $this->subscriber_wrapper, $this->dispatcher);
        $this->plugin->load([
            'prefix' => $prefix,
            'version' => '3.16'
        ], $providers);
    }
}