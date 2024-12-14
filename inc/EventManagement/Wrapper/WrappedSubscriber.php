<?php

namespace LaunchpadCore\EventManagement\Wrapper;

use LaunchpadCore\EventManagement\ClassicSubscriberInterface;
use LaunchpadDispatcher\Dispatcher;
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
	 * Container.
	 *
	 * @var ContainerInterface
	 */
	protected $container;

	protected $prefix;

	/**
	 * @var Dispatcher
	 */
	protected $dispatcher;

	/**
	 * @var string
	 */
	protected $classname;

	/**
	 * Instantiate the class.
	 *
	 * @param ContainerInterface $container Container.
	 * @param string             $classname Real Subscriber.
	 * @param array              $events Mapping from the events from the subscriber.
	 */
	public function __construct( ContainerInterface $container, Dispatcher $dispatcher, string $prefix, string $classname, array $events = [] ) {
		$this->container = $container;
		$this->classname  = $classname;
		$this->events    = $events;
		$this->prefix = $prefix;
		$this->dispatcher = $dispatcher;
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

		if("{$this->prefix}core_subscriber_callback_enabled" !== current_filter() && ! $this->dispatcher->apply_bool_filters("{$this->prefix}core_subscriber_callback_enabled", true, $this->classname, $name, $arguments)) {

			if ( count( $arguments ) === 0 ) {
				return;
			}

			$parameter = array_shift( $arguments );

			return $parameter;
		}

		if(! $this->instance) {
			$this->instance = $this->container->get($this->classname);
		}


		return $this->instance->{$name}( ...$arguments );
	}
}
