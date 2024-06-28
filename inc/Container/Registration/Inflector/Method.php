<?php

namespace LaunchpadCore\Container\Registration\Inflector;

class Method {

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var array
	 */
	protected $parameters = [];

	/**
	 * @param string $name
	 */
	public function __construct( string $name ) {
		$this->name = $name;
	}

	public function set_parameters( array $parameters ): self {
		$this->parameters = $parameters;
		return $this;
	}

	public function get_name(): string {
		return $this->name;
	}

	public function get_parameters(): array {
		return $this->parameters;
	}
}
