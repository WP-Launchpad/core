<?php

namespace LaunchpadCore\Tests\Fixtures\inc\Context\files\inc;

/**
 * @context LaunchpadCore\Tests\Fixtures\inc\Context\files\inc\ClassContext
 */
class ClassContextSubscriber {

	/**
	 * @hook my_class_event
	 */
	public function test_callback() {
		update_option('subscriber_logic', true);
	}
}