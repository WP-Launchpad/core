<?php

namespace LaunchpadCore\Deactivation\Wrapper;

use LaunchpadCore\Deactivation\DeactivationInterface;

class DeactivatorProxy implements DeactivationInterface {

	protected $deactivate_methods = [];

	protected $instance;

	/**
	 * @param array $activate_methods
	 */
	public function __construct( $instance, array $activate_methods ) {
		$this->instance           = $instance;
		$this->deactivate_methods = $activate_methods;
	}

	/**
	 * @inheritDoc
	 */
	public function deactivate() {
		foreach ( $this->deactivate_methods as $method ) {
			$this->instance->{$method}();
		}
	}
}