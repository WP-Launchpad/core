<?php

namespace LaunchpadCore\Tests\Integration\inc\boot;

use LaunchpadCore\Tests\Integration\TestCase;
use function LaunchpadCore\boot;

class Test_activate extends TestCase
{

    public function set_up()
    {
        parent::set_up();
        delete_option('demo_option');
    }

    public function tear_down()
    {
        delete_option('demo_option');
        parent::tear_down();
    }

    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected($config, $expected)
    {
        require_once LAUNCHPAD_PLUGIN_ROOT . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'boot.php';
        boot($config['plugin']);

        $activate_plugin_path = ltrim( $config['plugin'], DIRECTORY_SEPARATOR);
        do_action("activate_{$activate_plugin_path}");

        $this->assertTrue(get_option('demo_option', false), "option should be registered");
    }
}