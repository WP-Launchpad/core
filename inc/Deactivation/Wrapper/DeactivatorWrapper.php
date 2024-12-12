<?php

namespace LaunchpadCore\Deactivation\Wrapper;

use LaunchpadCore\Deactivation\DeactivationInterface;
use ReflectionClass;

class DeactivatorWrapper {
	/**
	 * Wrap a deactivator will the common interface for deactivators.
	 *
	 * @param object $instance Any class deactivator.
	 *
	 * @return DeactivationInterface
	 */
	public function wrap( $instance ): DeactivationInterface {
		if ( $instance instanceof DeactivationInterface ) {
			return $instance;
		}

		$methods            = get_class_methods( $instance );
		$reflection_class   = new ReflectionClass( get_class( $instance ) );
		$deactivate_methods = [];

		foreach ( $methods as $method ) {
			$method_reflection = $reflection_class->getMethod( $method );
			$doc_comment       = $method_reflection->getDocComment();
			if ( ! $doc_comment ) {
				continue;
			}
			$pattern = '#@deactivate#';

			preg_match_all( $pattern, $doc_comment, $matches, PREG_PATTERN_ORDER );
			if ( ! $matches ) {
				continue;
			}

			$deactivate_methods[] = $method;
		}

		return new DeactivatorProxy( $instance, $deactivate_methods );
	}
}
