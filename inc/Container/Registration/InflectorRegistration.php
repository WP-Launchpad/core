<?php

namespace LaunchpadCore\Container\Registration;

use LaunchpadCore\Container\Registration\Inflector\Method;
use LaunchpadCore\Container\Registration\Inflector\Property;
use League\Container\Container;

class InflectorRegistration {

	/**
	 * @var string
	 */
	protected $interface = '';

	/**
	 * @var Method[]
	 */
	protected $methods = [];

	/**
	 * @var Property[]
	 */
	protected $properties = [];

	/**
	 * @param string $interface
	 */
	public function __construct( string $interface ) {
		$this->interface = $interface;
	}

	public function add_method( string $method, array $paramters = [] ): self {
		$method = new Method( $method );
		$method->set_parameters( $paramters );
		$this->methods [] = $method;
		return $this;
	}

	public function add_property( $name, $value ): self {
		$property = new Property( $name, $value );

		$this->properties [] = $property;

		return $this;
	}

	/**
	 * Register a definition on a container.
	 *
	 * @param Container $container Container to register on.
	 * @return void
	 */
	public function register( Container $container ) {
		$inflector = $container->inflector( $this->interface );

		foreach ( $this->methods as $method ) {
			$inflector->invokeMethod( $method->get_name(), $method->get_parameters() );
		}

		foreach ( $this->properties as $property ) {
			$inflector->setProperty( $property->get_name(), $property->get_value() );
		}
	}
}
