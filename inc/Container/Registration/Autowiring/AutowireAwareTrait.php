<?php

namespace LaunchpadCore\Container\Registration\Autowiring;

trait AutowireAwareTrait {

	/**
	 * Autowire arguments.
	 *
	 * @var bool
	 */
	protected $autowire = false;

	/**
	 * Autowire arguments from the subscriber. (Works only if the autowiring is enabled on the project)
	 *
	 * @return void
	 */
	public function autowire(): void {
		$this->autowire = true;
	}

	/**
	 * Are arguments from the subscriber autowired.
	 *
	 * @return bool
	 */
	public function is_autowire(): bool {
		return $this->autowire;
	}
}
