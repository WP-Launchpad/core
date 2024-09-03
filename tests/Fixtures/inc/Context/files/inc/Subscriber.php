<?php

namespace LaunchpadCore\Tests\Fixtures\inc\Context\files\inc;

/**
 * @context \LaunchpadCore\Tests\Fixtures\inc\Context\files\inc\ClassContext
 */
class Subscriber {

	/**
	 * @hook my_event
	 * @context \LaunchpadCore\Tests\Fixtures\inc\Context\files\inc\Context
	 */
	public function test_callback() {
		update_option('subscriber_logic', true);
	}
}