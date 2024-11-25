<?php

namespace LaunchpadCore\EventManagement\Wrapper;

use LaunchpadCore\Dispatcher\Sanitizer\EventSanitizer;
use LaunchpadCore\EventManagement\ClassicSubscriberInterface;
use LaunchpadCore\EventManagement\OptimizedSubscriberInterface;
use LaunchpadDispatcher\Dispatcher;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;

class SubscriberWrapper {


	/**
	 * Plugin prefix.
	 *
	 * @var string
	 */
	protected $prefix = '';

	/**
	 * Container.
	 *
	 * @var ContainerInterface
	 */
	protected $container;

	/**
	 * @var Dispatcher
	 *
	 */
	protected $dispatcher;

	/**
	 * Instantiate class.
	 *
	 * @param string             $prefix Plugin prefix.
	 * @param ContainerInterface $container Container.
	 */
	public function __construct( string $prefix, ContainerInterface $container, Dispatcher $dispatcher) {
		$this->prefix    = $prefix;
		$this->container = $container;
		$this->dispatcher = $dispatcher;
	}

	/**
	 * Wrap a subscriber will the common interface for subscribers.
	 *
	 * @param string $instance Any class subscriber.
	 *
	 * @return ClassicSubscriberInterface
	 * @throws ReflectionException Error is the class name is not valid.
	 */
	public function wrap( string $instance ): ClassicSubscriberInterface {
		$parents = class_implements( $instance );

		if ( in_array(OptimizedSubscriberInterface::class, $parents) ) {
			return new WrappedSubscriber( $this->container, $this->dispatcher, $this->prefix, $instance, $instance::get_subscribed_events() );
		}

		if( in_array( ClassicSubscriberInterface::class, $parents ) ) {
			return new $instance;
		}

		$methods          = get_class_methods( $instance );
		$reflection_class = new ReflectionClass( $instance );
		$events           = [];
		foreach ( $methods as $method ) {
			$method_reflection   = $reflection_class->getMethod( $method );
			$doc_comment         = $method_reflection->getDocComment();
			if ( ! $doc_comment ) {
				continue;
			}
			$pattern = '#@hook\s(?<name>[a-zA-Z\\\-_$/]+)(\s(?<priority>[0-9]+))?#';

			preg_match_all( $pattern, $doc_comment, $matches, PREG_PATTERN_ORDER );
			if ( ! $matches ) {
				continue;
			}


			foreach ( $matches[0] as $index => $match ) {
				$hook = str_replace( '$prefix', $this->prefix, $matches['name'][ $index ] );
				$hook = $this->dispatcher->apply_string_filters("{$this->prefix}core_subscriber_event_hook", $hook, $instance);

				$events[ $hook ][] = [
					$method,
					key_exists( 'priority', $matches ) && key_exists( $index, $matches['priority'] ) && '' !== $matches['priority'][ $index ] ? (int) $matches['priority'][ $index ] : 10,
					$method_reflection->getNumberOfParameters(),
				];
			}
		}

		$events = $this->dispatcher->apply_filters("{$this->prefix}core_subscriber_events", new EventSanitizer(), $events, $instance);

		return new WrappedSubscriber( $this->container, $this->dispatcher, $this->prefix, $instance, $events );
	}
}
