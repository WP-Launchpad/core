<?php

namespace LaunchpadCore\EventManagement\Wrapper;

use LaunchpadCore\EventManagement\ClassicSubscriberInterface;

class WrappedSubscriber implements ClassicSubscriberInterface {

	/**
	 * Real Subscriber.
	 *
	 * @var object
	 */
	protected $object;

	/**
	 * Mapping from the events from the subscriber.
	 *
	 * @var array
	 */
	protected $events;

	/**
	 * Instantiate the class.
	 *
	 * @param object $object Real Subscriber.
	 * @param array  $events Mapping from the events from the subscriber.
	 */
	public function __construct( $object, array $events = [] ) {
		$this->object = $object;
		$this->events = $events;
	}

	/**
	 * @inheritDoc
	 */
	public function get_subscribed_events(): array {
		return $this->events;
	}

	/**
	 * Delegate callbacks to the actual subscriber.
	 *
	 * @param string $name Name from the method.
	 * @param array  $arguments Parameters from the method.
	 *
	 * @return mixed
	 */
	public function __call( $name, $arguments ) {

		if ( method_exists( $this, $name ) ) {
			return $this->{$name}( ...$arguments );
		}

		return $this->object->{$name}( ...$arguments );
	}
}
