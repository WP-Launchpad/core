<?php

namespace LaunchpadCore\Tests\Integration\inc\Plugin;

use LaunchpadCore\EventManagement\EventManager;
use LaunchpadCore\EventManagement\Wrapper\SubscriberWrapper;
use LaunchpadCore\Plugin;
use LaunchpadCore\Tests\Integration\inc\Traits\SetupPluginTrait;
use LaunchpadCore\Tests\Integration\TestCase;
use LaunchpadDispatcher\Dispatcher;
use League\Container\Container;

/**
 * @covers \LaunchpadCore\Plugin::load
 */
class Test_load extends TestCase {
    use SetupPluginTrait;

    public function testShouldDoAsExpected()
    {
        $this->event_manager = new EventManager();

        $prefix = 'test';

        $event_setup = [
            'common_hook',
            'front_hook',
            'init_hook',
            'optimize_init',
            'classic_hook',
            'root_hook',
            'optimize_hook',
        ];

        $event_not_setup = [
            'admin_hook'
        ];

        $events =array_merge($event_setup, $event_not_setup);

        foreach ($events as $event) {
            $this->assertFalse($this->event_manager->has_callback($event), $event);
        }

        $this->setup_plugin($prefix, [
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\common\ServiceProvider::class,
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\admin\ServiceProvider::class,
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\front\ServiceProvider::class,
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\init\ServiceProvider::class,
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\optimize\ServiceProvider::class,
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\classic\ServiceProvider::class,
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\root\ServiceProvider::class,
        ]);

        foreach ($event_setup as $event) {
            $this->assertTrue($this->event_manager->has_callback($event), $event);
        }

        foreach ($event_not_setup as $event) {
            $this->assertFalse($this->event_manager->has_callback($event), $event);
        }

        $actions = [
          "{$prefix}before_load",
          "{$prefix}after_load",
        ];

        $filters = [
            "{$prefix}container",
            "{$prefix}load_provider_subscribers",
            "{$prefix}load_init_subscribers",
            "{$prefix}load_subscribers",
        ];
        foreach ($actions as $action) {
            did_action($action);
        }

        foreach ($filters as $filter) {
            did_filter($filter);
        }

        $services = [
            Dispatcher::class => Dispatcher::class,
            'dispatcher' => Dispatcher::class,
            EventManager::class => EventManager::class,
            'event_manager' => EventManager::class,
        ];

        foreach ($services as $key => $class) {
            $this->assertInstanceOf($class, $this->container->get($key));
        }
    }
}
