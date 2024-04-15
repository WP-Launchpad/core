<?php

namespace LaunchpadCore\Tests\Integration\inc\boot;

use LaunchpadCore\Tests\Integration\TestCase;
use function LaunchpadCore\boot;

class
Test_deactivate extends TestCase
{

    public function set_up()
    {
        parent::set_up();
        update_option('demo_option', true);
    }

    public function tear_down()
    {
        delete_option('demo_option');
        parent::tear_down();
    }

    public function testShouldDoAsExpected()
    {
        require_once LAUNCHPAD_PLUGIN_ROOT . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'boot.php';
        $plugin_path = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'plugin.php';
        boot($plugin_path);

        $activate_plugin_path = ltrim( $plugin_path, DIRECTORY_SEPARATOR);
        do_action("deactivate_{$activate_plugin_path}");

        $this->assertFalse(get_option('demo_option', false), "option should be unregistered");
    }
}