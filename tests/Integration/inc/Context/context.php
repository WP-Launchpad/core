<?php

namespace LaunchpadCore\Tests\Integration\inc\Context;

use LaunchpadCore\Tests\Integration\TestCase;
use function LaunchpadCore\boot;

class Test_context extends TestCase {

	public function tear_down() {
		parent::tear_down();
		delete_option('class_context');
		delete_option('subscriber_logic');
		delete_option('method_context');
	}

	/**
	 * @dataProvider configTestData
	 */
	public function testShouldDoAsExpected($config, $expected) {
		$this->markTestSkipped('Context no longer part of core');
		require_once LAUNCHPAD_PLUGIN_ROOT . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'boot.php';

		boot($config['plugin']);

		do_action('plugins_loaded');

		do_action($config['event']);

		$this->assertSame(get_option('class_context'), $expected['class_context']);
		$this->assertSame(get_option('subscriber_logic'), $expected['subscriber_logic']);
		$this->assertSame(get_option('method_context'), $expected['method_context']);
	}
}