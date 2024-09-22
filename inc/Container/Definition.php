<?php

namespace LaunchpadCore\Container;

use League\Container\Argument\ArgumentInterface;
use League\Container\Argument\ClassNameInterface;
use League\Container\Argument\LiteralArgumentInterface;
use League\Container\Argument\RawArgumentInterface;

class Definition extends \League\Container\Definition\Definition {

	/**
	 * Resolve class.
	 *
	 * @param bool $new Force new class.
	 *
	 * @return mixed|object|string
	 */
	public function resolve( bool $new = false ) { // phpcs:ignore Squiz.Commenting.FunctionComment.MissingParamTag,Universal.NamingConventions.NoReservedKeywordParameterNames.newFound
		$concrete = $this->concrete;

		if ( $this->isShared() && ( null !== $this->resolved ) && false === $new ) {
			return $this->resolved;
		}

		if ( is_callable( $concrete ) ) {
			$concrete = $this->resolveCallable( $concrete );
		}

		if ( $concrete instanceof RawArgumentInterface ) {
			$this->resolved = $concrete->getValue();

			return $concrete->getValue();
		}

		if ( $concrete instanceof ClassNameInterface ) {
			$concrete = $concrete->getClassName();
		}

		if ( is_string( $concrete ) ) {
			if ( $this->alias !== $this->concrete && is_string( $concrete ) && $this->getContainer()->has( $concrete ) ) {
				$concrete = $this->getContainer()->get( $concrete );
			}
			elseif ( class_exists( $concrete ) ) {
					$concrete = $this->resolveClass( $concrete );
			}
		}

		if ( is_object( $concrete ) ) {
			$concrete = $this->invokeMethods( $concrete );
		}

		$this->resolved = $concrete;

		return $concrete;
	}
}
