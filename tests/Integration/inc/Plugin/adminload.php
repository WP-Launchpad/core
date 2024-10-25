<?php

namespace LaunchpadCore\Tests\Integration\inc\Plugin;

use LaunchpadCore\EventManagement\EventManager;
use LaunchpadCore\Tests\Integration\inc\Plugin\classes\method_registration_init\ServiceProvider;
use LaunchpadCore\Tests\Integration\inc\Traits\SetupPluginTrait;
use LaunchpadCore\Tests\Integration\TestCase;

/**
 * @covers \LaunchpadCore\Plugin::load
 * @group AdminOnly
 */
class Test_adminload extends TestCase {

    use SetupPluginTrait;

    public function testShouldDoAsExpected()
    {
        $prefix = 'test';

        $this->event_manager = new EventManager();

        $event_setup = [
            'admin_hook',
            'common_hook',
            'init_hook',
            'method_registration_common_hook',
            'method_registration_init_hook',
            'method_registration_admin_hook',
        ];

        $event_not_setup = [
            'front_hook',
            'method_registration_front_hook',
        ];

        $events =array_merge($event_setup, $event_not_setup);

        foreach ($events as $event) {
            $this->assertFalse($this->event_manager->has_callback($event), "$event is setup");
        }

        $this->setup_plugin($prefix, [
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\common\ServiceProvider::class,
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\admin\ServiceProvider::class,
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\front\ServiceProvider::class,
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\init\ServiceProvider::class,
            ServiceProvider::class,
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\method_registration_admin\ServiceProvider::class,
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\method_registration_front\ServiceProvider::class,
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\method_registration_common\ServiceProvider::class,
        ]);

        foreach ($event_setup as $event) {
            $this->assertTrue($this->event_manager->has_callback($event), "$event is not setup");
        }

        foreach ($event_not_setup as $event) {
            $this->assertFalse($this->event_manager->has_callback($event), "$event is setup");
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
    }
}
