<?php

namespace LaunchpadCore\Activation\Wrapper;

use LaunchpadCore\Activation\ActivationInterface;
use ReflectionClass;

class ActivatorWrapper {
	/**
	 * @param $instance
	 *
	 * @return ActivationInterface
	 * @throws \ReflectionException
	 */
	public function wrap( $instance ): ActivationInterface {
		if ( $instance instanceof ActivationInterface ) {
			return $instance;
		}

		$methods          = get_class_methods( $instance );
		$reflection_class = new ReflectionClass( get_class( $instance ) );
		$activate_methods = [];

		foreach ( $methods as $method ) {
			$method_reflection = $reflection_class->getMethod( $method );
			$doc_comment       = $method_reflection->getDocComment();
			if ( ! $doc_comment ) {
				continue;
			}
			$pattern = '#@activate#';

			preg_match_all( $pattern, $doc_comment, $matches, PREG_PATTERN_ORDER );
			if ( ! $matches ) {
				continue;
			}

			$activate_methods[] = $method;
		}

		return new ActivatorProxy($instance, $activate_methods);
	}
}