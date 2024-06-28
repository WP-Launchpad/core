<?php
// phpcs:ignoreFile

namespace LaunchpadCore\Container\Autowiring;

use League\Container\Argument\ClassName;
use League\Container\Argument\ClassNameWithOptionalValue;
use League\Container\Argument\RawArgument;
use League\Container\ReflectionContainer;
use ReflectionFunctionAbstract;
use ReflectionParameter;

class Container extends ReflectionContainer {

	/**
	 * {@inheritdoc}
	 */
	public function reflectArguments( ReflectionFunctionAbstract $method, array $args = [] ): array {
		$arguments = array_map(
			function ( ReflectionParameter $param ) use ( $method, $args ) {
				$name = $param->getName();
				$type = $param->getType();

				if ( array_key_exists( $name, $args ) ) {
					return new RawArgument( $args[ $name ] );
				}

				if ( $type ) {
					if ( PHP_VERSION_ID >= 70100 ) {
						$typeName = $type->getName();
					} else {
						$typeName = (string) $type;
					}

					$typeName = ltrim( $typeName, '?' );

					if ( ! in_array( $typeName, [ 'string', 'float', 'int', 'bool', 'array', 'object' ], true ) ) {
						if ( $param->isDefaultValueAvailable() ) {
							return new ClassNameWithOptionalValue( $typeName, $param->getDefaultValue() );
						}

						return new ClassName( $typeName );
					}
				}

				if ( $param->isDefaultValueAvailable() ) {
					return new RawArgument( $param->getDefaultValue() );
				}

				$name = rtrim( $name, '$' );

				return new ClassName( $name );
			},
			$method->getParameters()
			);

		return $this->resolveArguments( $arguments );
	}
}
