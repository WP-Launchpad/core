<?php

namespace LaunchpadCore\Dispatcher\Sanitizer;

use LaunchpadDispatcher\Interfaces\SanitizerInterface;

class EventSanitizer implements SanitizerInterface {

	/**
	 * @inheritDoc
	 */
	public function sanitize( $value ) {
		if(! is_array($value)) {
			return false;
		}
		return $value;
	}

	/**
	 * @inheritDoc
	 */
	public function is_default( $value, $original ): bool {
		return $value === false;
	}
}