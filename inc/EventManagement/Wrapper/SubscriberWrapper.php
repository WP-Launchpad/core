<?php

namespace LaunchpadCore\EventManagement\Wrapper;

use LaunchpadCore\EventManagement\OptimizedSubscriberInterface;
use LaunchpadCore\EventManagement\SubscriberInterface;
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
	 * Instantiate class.
	 *
	 * @param string             $prefix Plugin prefix.
	 * @param ContainerInterface $container Container.
	 */
	public function __construct( string $prefix, ContainerInterface $container ) {
		$this->prefix    = $prefix;
		$this->container = $container;
	}

	/**
	 * Wrap a subscriber will the common interface for subscribers.
	 *
	 * @param object $instance Any class subscriber.
	 *
	 * @return SubscriberInterface
	 * @throws ReflectionException Error is the class name is not valid.
	 */
	public function wrap( $instance ): SubscriberInterface {
		if ( $instance instanceof OptimizedSubscriberInterface ) {
			return new WrappedSubscriber( $this->container, $instance, $instance->get_subscribed_events() );
		}

		$methods          = get_class_methods( $instance );
		$reflection_class = new ReflectionClass( get_class( $instance ) );
		$events           = [];
		$contexts         = [];
		$docblock         = $reflection_class->getDocComment() ? $reflection_class->getDocComment() : '';
		$context          = $this->fetch_context( $docblock );
		foreach ( $methods as $method ) {
			$contexts[ $method ] = $context;
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

			$method_context = $this->fetch_context( $doc_comment );

			if ( $method_context ) {
				$contexts[ $method ] = $method_context;
			}

			foreach ( $matches[0] as $index => $match ) {
				$hook = str_replace( '$prefix', $this->prefix, $matches['name'][ $index ] );

				$events[ $hook ][] = [
					$method,
					key_exists( 'priority', $matches ) && key_exists( $index, $matches['priority'] ) && '' !== $matches['priority'][ $index ] ? (int) $matches['priority'][ $index ] : 10,
					$method_reflection->getNumberOfParameters(),
				];
			}
		}

		return new WrappedSubscriber( $this->container, $instance, $events, $contexts );
	}

	/**
	 * Fetch context from the docblock.
	 *
	 * @param string $docblock Docblock to fetch from.
	 *
	 * @return string|null
	 */
	protected function fetch_context( string $docblock ) {
		if ( '' === $docblock ) {
			return null;
		}

		$pattern = '#@context\s(?<name>[a-zA-Z0-9\\\-_$/]+)#';

		preg_match( $pattern, $docblock, $match );
		if ( ! $match ) {
			return null;
		}

		if ( ! class_exists( $match['name'] ) ) {
			return null;
		}

		return $match['name'];
	}
}
