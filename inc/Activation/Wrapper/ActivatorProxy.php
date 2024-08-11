<?php

namespace LaunchpadCore\Activation\Wrapper;

use LaunchpadCore\Activation\ActivationInterface;

class ActivatorProxy implements ActivationInterface {

	protected $activate_methods = [];

	protected $instance;

	/**
	 * @param array $activate_methods
	 */
	public function __construct( $instance, array $activate_methods ) {
		$this->instance         = $instance;
		$this->activate_methods = $activate_methods;
	}

	/**
	 * @inheritDoc
	 */
	public function activate() {
		foreach ( $this->activate_methods as $method ) {
			$this->instance->{$method}();
		}
	}
}
