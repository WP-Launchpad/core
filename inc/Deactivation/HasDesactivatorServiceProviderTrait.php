<?php

namespace LaunchpadCore\Deactivation;

use LaunchpadCore\Container\Registration\DeactivatorRegistration;
use LaunchpadCore\Container\Registration\Registration;

trait HasDesactivatorServiceProviderTrait {

	/**
	 * Returns list of deactivators.
	 *
	 * @return string[]
	 */
	public function get_deactivators(): array {
		$this->load();

		$deasactivators = [];

		foreach ( $this->get_services_to_load() as $registration ) {
			if ( ! $registration instanceof DeactivatorRegistration ) {
				continue;
			}

			$deasactivators [] = $registration->get_id();
		}

		return $deasactivators;
	}

	/**
	 * Register deactivator.
	 *
	 * @param string $classname Classname from the deactivator.
	 * @return DeactivatorRegistration
	 */
	public function register_deactivator( string $classname ): DeactivatorRegistration {
		$registration = new DeactivatorRegistration( $classname );

		$this->services_to_load[] = $registration;

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
