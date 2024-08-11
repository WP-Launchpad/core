<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\autowiring\inc;

class AnnotationActivator {

	/**
	 * @activate
	 */
	public function update() {
		update_option('demo_option_2', true);
	}
}