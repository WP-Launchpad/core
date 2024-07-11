<?php

namespace LaunchpadCore\Tests\Integration\inc\Plugin;

use LaunchpadCore\EventManagement\EventManager;
use LaunchpadCore\Tests\Integration\inc\Traits\SetupPluginTrait;
use LaunchpadCore\Tests\Integration\TestCase;

/**
 * @covers \LaunchpadCore\Plugin::load
 */
class Test_commonhookparsing extends TestCase {
    use SetupPluginTrait;

    protected $prefix = 'test';

    public function testShouldDoAsExpected()
    {
        $this->event_manager = new EventManager();

        $event_setup = [
            'common_hook',
            'common_callback_with_more_spaces',
            'common_callback_with_numbers_in_name_2024',
        ];

        $this->setup_plugin($this->prefix, [
            \LaunchpadCore\Tests\Integration\inc\Plugin\classes\common\ServiceProvider::class,
        ]);

        foreach ($event_setup as $event) {
            $this->assertTrue($this->event_manager->has_callback($event), $event);
        }

        $actions = [
            "{$this->prefix}before_load",
            "{$this->prefix}after_load",
        ];

        $filters = [
            "{$this->prefix}container",
            "{$this->prefix}load_provider_subscribers",
            "{$this->prefix}load_init_subscribers",
            "{$this->prefix}load_subscribers",
        ];
        foreach ($actions as $action) {
            did_action($action);
        }

        foreach ($filters as $filter) {
            did_filter($filter);
        }
    }

    /**
     * @hook $prefixload_init_subscribers
     */
    public function invalid_subscriber_list()
    {
        return [];
    }
}
