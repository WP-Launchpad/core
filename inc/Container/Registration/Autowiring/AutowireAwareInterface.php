<?php

namespace LaunchpadCore\Container\Registration\Autowiring;

interface AutowireAwareInterface {

	/**
	 * Are arguments from the subscriber autowired.
	 *
	 * @return bool
	 */
	public function is_autowire(): bool;

	/**
	 * Autowire arguments from the subscriber. (Works only if the autowiring is enabled on the project)
	 *
	 * @return void
	 */
	public function autowire(): void;
}
