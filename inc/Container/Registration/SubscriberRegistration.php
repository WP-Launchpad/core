<?php

namespace LaunchpadCore\Container\Registration;

use LaunchpadCore\Container\Registration\Registration;

class SubscriberRegistration extends Registration {

	/**
	 * Type of subscriber.
	 *
	 * @var string
	 */
	protected $type;

	/**
	 * Autowire arguments.
	 *
	 * @var bool
	 */
	protected $autowire = false;

	/**
	 * Instantiate the class.
	 *
	 * @param string $id Id from the class.
	 * @param string $type Type from the subscriber.
	 */
	public function __construct( string $id, string $type ) {
		parent::__construct( $id );
		$this->type = $type;
	}

	/**
	 * Get the type of subscriber.
	 *
	 * @return string
	 */
	public function get_type(): string {
		return $this->type;
	}

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
