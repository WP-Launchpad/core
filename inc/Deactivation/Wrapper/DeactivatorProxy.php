<?php

namespace LaunchpadCore\Deactivation\Wrapper;

use LaunchpadCore\Deactivation\DeactivationInterface;

class DeactivatorProxy implements DeactivationInterface {

	/**
	 * List of method to call.
	 *
	 * @var string[]
	 */
	protected $deactivate_methods = [];

	/**
	 * Any class activator.
	 *
	 * @var object
	 */
	protected $instance;

	/**
	 * Instantiate the proxy.
	 *
	 * @param object $instance Any class deactivator.
	 * @param array  $deactivate_methods List of method to call.
	 */
	public function __construct( $instance, array $deactivate_methods ) {
		$this->instance           = $instance;
		$this->deactivate_methods = $deactivate_methods;
	}

	/**
	 * Executes this method on plugin deactivation
	 *
	 * @return void
	 */
	public function deactivate() {
		foreach ( $this->deactivate_methods as $method ) {
			$this->instance->{$method}();
		}
	}
}