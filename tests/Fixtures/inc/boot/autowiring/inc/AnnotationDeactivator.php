<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\autowiring\inc;

class AnnotationDeactivator {
	/**
	 * @deactivate
	 */
	public function update() {
		delete_option('demo_option_2');
	}
}