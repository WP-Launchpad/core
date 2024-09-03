<?php

namespace LaunchpadCore\EventManagement\Wrapper;

use LaunchpadCore\EventManagement\ClassicSubscriberInterface;
use Psr\Container\ContainerInterface;

class WrappedSubscriber implements ClassicSubscriberInterface {

	/**
	 * Real Subscriber.
	 *
	 * @var object
	 */
	protected $instance;

	/**
	 * Mapping from the events from the subscriber.
	 *
	 * @var array
	 */
	protected $events;

	/**
	 * Methods contexts.
	 *
	 * @var array
	 */
	protected $contexts;

	/**
	 * Container.
	 *
	 * @var ContainerInterface
	 */
	protected $container;

	/**
	 * Instantiate the class.
	 *
	 * @param ContainerInterface $container Container.
	 * @param object             $instance Real Subscriber.
	 * @param array              $events Mapping from the events from the subscriber.
	 * @param array              $contexts Methods contexts.
	 */
	public function __construct( ContainerInterface $container, $instance, array $events = [], array $contexts = [] ) {
		$this->container = $container;
		$this->instance  = $instance;
		$this->events    = $events;
		$this->contexts  = $contexts;
	}

	/**
	 * Returns an array of events that this subscriber wants to listen to.
	 *
	 * The array key is the event name. The value can be:
	 *
	 *  * The method name
	 *  * An array with the method name and priority
	 *  * An array with the method name, priority and number of accepted arguments
	 *
	 * For instance:
	 *
	 *  * array('hook_name' => 'method_name')
	 *  * array('hook_name' => array('method_name', $priority))
	 *  * array('hook_name' => array('method_name', $priority, $accepted_args))
	 *  * array('hook_name' => array(array('method_name_1', $priority_1, $accepted_args_1)), array('method_name_2', $priority_2, $accepted_args_2)))
	 *
	 * @return array
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
	 * @return mixed|void
	 */
	public function __call( $name, $arguments ) {

		if ( method_exists( $this, $name ) ) {
			return $this->{$name}( ...$arguments );
		}

		if ( ! key_exists( $name, $this->contexts ) || ! $this->contexts[ $name ] || $this->container->get( $this->contexts[ $name ] )() ) {
			return $this->instance->{$name}( ...$arguments );
		}

		if ( count( $arguments ) === 0 ) {
			return;
		}

		$parameter = array_shift( $arguments );

		return $parameter;
	}
}
