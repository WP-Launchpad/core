<?php

namespace LaunchpadCore\Activation;

use LaunchpadCore\Container\Registration\ActivatorRegistration;
use LaunchpadCore\Container\Registration\Registration;

trait HasActivatorServiceProviderTrait {

	/**
	 * Returns list of activators.
	 *
	 * @return string[]
	 */
	public function get_activators(): array {
		$this->load();

		$activators = [];

		foreach ( $this->get_services_to_load() as $registration ) {
			if ( ! $registration instanceof ActivatorRegistration ) {
				continue;
			}

			$activators [] = $registration->get_id();
		}

		return $activators;
	}

	/**
	 * Register activator.
	 *
	 * @param string $classname Classname from the activator.
	 * @return ActivatorRegistration
	 */
	public function register_activator( string $classname ): ActivatorRegistration {
		$registration = new ActivatorRegistration( $classname );

		$this->add_service_to_load( $registration );

		return $registration;
	}

	/**
	 * Loads definitions.
	 *
	 * @return void
	 */
	abstract protected function load();

	/**
	 * Get the service to load.
	 *
	 * @return Registration[]
	 */
	abstract protected function get_services_to_load(): array;

	/**
	 * Add to the list of service to load.
	 *
	 * @param Registration $registration Registration from the service to add.
	 * @return void
	 */
	abstract protected function add_service_to_load( Registration $registration ): void;
}
