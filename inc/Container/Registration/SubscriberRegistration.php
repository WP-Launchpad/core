<?php

namespace LaunchpadCore\Container\Registration;

use LaunchpadCore\Container\Registration\Autowiring\AutowireAwareInterface;
use LaunchpadCore\Container\Registration\Autowiring\AutowireAwareTrait;

class SubscriberRegistration extends Registration implements AutowireAwareInterface {
    use AutowireAwareTrait;
    
	/**
	 * Type of subscriber.
	 *
	 * @var string
	 */
	protected $type;
    
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
}
