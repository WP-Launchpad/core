<?php

namespace LaunchpadCore\Tests\Integration\inc\boot;

use LaunchpadCore\Tests\Integration\TestCase;
use function LaunchpadCore\boot;

class Test_boot extends TestCase
{
    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected($config, $expected)
    {
        require_once LAUNCHPAD_PLUGIN_ROOT . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'boot.php';

        boot($config['plugin']);

        do_action('plugins_loaded');

        $container = apply_filters('demo_container', null);

        $this->assertTrue($container->get('event_manager')->has_callback('hook'), "hook should be registered");

        do_action('hook');
    }
}