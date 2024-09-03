<?php

namespace LaunchpadCore\Tests\Fixtures\inc\Context\files\inc;

class Context {
	public function __invoke() {
		update_option('method_context', true);
		return false;
	}
}