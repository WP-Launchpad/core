<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\files\inc;


class AnnotationDeactivator {
	/**
	 * @deactivate
	 */
	public function update() {
		delete_option('demo_option_2');
	}
}