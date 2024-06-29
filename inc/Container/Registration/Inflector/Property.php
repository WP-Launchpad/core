<?php

namespace LaunchpadCore\Container\Registration\Inflector;

class Property {

	/**
	 * Property name.
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * Property value.
	 *
	 * @var mixed
	 */
	protected $value;

	/**
	 * Instantiate property.
	 *
	 * @param string $name Property name.
	 * @param mixed  $value Property value.
	 */
	public function __construct( string $name, $value ) {
		$this->name  = $name;
		$this->value = $value;
	}

	/**
	 * Property name.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return $this->name;
	}

	/**
	 * Property value.
	 *
	 * @return mixed
	 */
	public function get_value() {
		return $this->value;
	}
}
