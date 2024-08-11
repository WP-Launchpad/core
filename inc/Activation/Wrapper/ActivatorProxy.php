<?php

namespace LaunchpadCore\Activation\Wrapper;

use LaunchpadCore\Activation\ActivationInterface;

class ActivatorProxy implements ActivationInterface {

	/**
	 * List of method to call.
	 *
	 * @var string[]
	 */
	protected $activate_methods = [];

	/**
	 * Any class activator.
	 *
	 * @var object
	 */
	protected $instance;

	/**
	 * Instantiate the proxy.
	 *
	 * @param object $instance Any class activator.
	 * @param array  $activate_methods List of method to call.
	 */
	public function __construct( $instance, array $activate_methods ) {
		$this->instance         = $instance;
		$this->activate_methods = $activate_methods;
	}

	/**
	 * Executes this method on plugin activation
	 *
	 * @return void
	 */
	public function activate() {
		foreach ( $this->activate_methods as $method ) {
			$this->instance->{$method}();
		}
	}
}
