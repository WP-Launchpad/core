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

	public function autowire(): void {
		$this->autowire = true;
	}

	public function is_autowire(): bool {
		return $this->autowire;
	}
}
