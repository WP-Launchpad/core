<?php

namespace LaunchpadCore\Container\Registration\Inflector;

class Method {

	/**
	 * Method name.
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * Method parameters.
	 *
	 * @var array
	 */
	protected $parameters = [];

	/**
	 * Set the method name.
	 *
	 * @param string $name Method name.
	 */
	public function __construct( string $name ) {
		$this->name = $name;
	}

	/**
	 * Set method parameters.
	 *
	 * @param array $parameters Method parameters.
	 * @return $this
	 */
	public function set_parameters( array $parameters ): self {
		$this->parameters = $parameters;
		return $this;
	}

	/**
	 * Get the method name.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return $this->name;
	}

	/**
	 * Get the method parameters.
	 *
	 * @return array
	 */
	public function get_parameters(): array {
		return $this->parameters;
	}
}
