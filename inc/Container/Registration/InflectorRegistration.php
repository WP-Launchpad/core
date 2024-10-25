<?php

namespace LaunchpadCore\Container\Registration;

use LaunchpadCore\Container\Registration\Inflector\Method;
use LaunchpadCore\Container\Registration\Inflector\Property;
use League\Container\Container;

class InflectorRegistration {

	/**
	 * Interface used to inflect object.
	 *
	 * @var string
	 */
	protected $interface_class = '';

	/**
	 * Inflector methods.
	 *
	 * @var Method[]
	 */
	protected $methods = [];

	/**
	 * Inflector properties.
	 *
	 * @var Property[]
	 */
	protected $properties = [];

	/**
	 * Instantiate inflector registration.
	 *
	 * @param string $interface_class Interface used to inflect object.
	 */
	public function __construct( string $interface_class ) {
		$this->interface_class = $interface_class;
	}

	/**
	 * Add new method.
	 *
	 * @param string $method Method name.
	 * @param array  $paramters Method parameters.
	 * @return $this
	 */
	public function add_method( string $method, array $paramters = [] ): self {
		$method = new Method( $method );
		$method->set_parameters( $paramters );
		$this->methods [] = $method;
		return $this;
	}

	/**
	 * Add a new property to inflect.
	 *
	 * @param string $name Property name.
	 * @param mixed  $value Property value.
	 * @return $this
	 */
	public function add_property( string $name, $value ): self {
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
		$inflector = $container->inflector( $this->interface_class );

		foreach ( $this->methods as $method ) {
			$inflector->invokeMethod( $method->get_name(), $method->get_parameters() );
		}

		foreach ( $this->properties as $property ) {
			$inflector->setProperty( $property->get_name(), $property->get_value() );
		}
	}
}
