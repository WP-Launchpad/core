<?php

namespace LaunchpadCore\Tests\Fixtures\inc\Context\files\inc;

class ClassContext {
	public function __invoke() {
		update_option('class_context', true);
		return false;
	}
}