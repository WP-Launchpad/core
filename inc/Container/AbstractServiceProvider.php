<?php

namespace LaunchpadCore\Container;

use LaunchpadCore\Container\Registration\Registration;
use LaunchpadCore\Container\Registration\SubscriberRegistration;
use League\Container\ServiceProvider\AbstractServiceProvider as LeagueServiceProvider;

abstract class AbstractServiceProvider extends LeagueServiceProvider implements ServiceProviderInterface {

	/**
	 * Services to load.
	 *
	 * @var array
	 */
	protected $services_to_load = [];

	/**
	 * Indicates if the service provider already loaded.
	 *
	 * @var bool
	 */
	protected $loaded = false;

	/**
	 * Return IDs provided by the Service Provider.
	 *
	 * @return string[]
	 */
	public function declares(): array {
		return $this->provides;
	}

	/**
	 * Returns a boolean if checking whether this provider provides a specific
	 * service or returns an array of provided services if no argument passed.
	 *
	 * @param string $alias Class searched.
	 *
	 * @return boolean
	 */
	public function provides( string $alias ): bool {
		$this->load();

		return parent::provides( $alias );
	}

	/**
	 * Return IDs from front subscribers.
	 *
	 * @return string[]
	 */
	public function get_front_subscribers(): array {
		$this->load();

		return $this->fetch_subscribers_by_type( 'front' );
	}

	/**
	 * Return IDs from admin subscribers.
	 *
	 * @return string[]
	 */
	public function get_admin_subscribers(): array {
		$this->load();

		return $this->fetch_subscribers_by_type( 'admin' );
	}

	/**
	 * Return IDs from common subscribers.
	 *
	 * @return string[]
	 */
	public function get_common_subscribers(): array {
		$this->load();

		return $this->fetch_subscribers_by_type( 'common' );
	}

	/**
	 * Return IDs from init subscribers.
	 *
	 * @return string[]
	 */
	public function get_init_subscribers(): array {
		$this->load();

		return $this->fetch_subscribers_by_type( 'init' );
	}

	/**
	 * Register service into the provider.
	 *
	 * @param string        $classname Class to register.
	 * @param callable|null $method Method called when registering.
	 * @param string        $concrete Concrete class when necessary.
	 * @return Registration
	 */
	public function register_service( string $classname, callable $method = null, string $concrete = '' ): Registration {

		$registration = new Registration( $classname );

		if ( $method ) {
			$registration->set_definition( $method );
		}

		if ( $concrete ) {
			$registration->set_concrete( $concrete );
		}

		$this->services_to_load[] = $registration;

		if ( ! in_array( $classname, $this->provides, true ) ) {
			$this->provides[] = $classname;
		}

		return $registration;
	}

	/**
	 * Register a subscriber.
	 *
	 * @param string $classname Classname from the subscriber.
	 * @param string $type Type of the subscriber.
	 * @return SubscriberRegistration
	 */
	protected function register_subscriber( string $classname, string $type ): SubscriberRegistration {
		$registration = new SubscriberRegistration( $classname, $type );

		$this->services_to_load[] = $registration;

		if ( ! in_array( $classname, $this->provides, true ) ) {
			$this->provides[] = $classname;
		}

		return $registration;
	}

	/**
	 * Register an admin subscriber.
	 *
	 * @param string $classname Classname from the subscriber.
	 * @return SubscriberRegistration
	 */
	public function register_admin_subscriber( string $classname ): SubscriberRegistration {
		return $this->register_subscriber( $classname, 'admin' );
	}

	/**
	 * Register a front subscriber.
	 *
	 * @param string $classname Classname from the subscriber.
	 * @return SubscriberRegistration
	 */
	public function register_front_subscriber( string $classname ): SubscriberRegistration {
		return $this->register_subscriber( $classname, 'front' );
	}

	/**
	 * Register a common subscriber.
	 *
	 * @param string $classname Classname from the subscriber.
	 * @return SubscriberRegistration
	 */
	public function register_common_subscriber( string $classname ): SubscriberRegistration {
		return $this->register_subscriber( $classname, 'common' );
	}

	/**
	 * Register an init subscriber.
	 *
	 * @param string $classname Classname from the subscriber.
	 * @return SubscriberRegistration
	 */
	public function register_init_subscriber( string $classname ): SubscriberRegistration {
		return $this->register_subscriber( $classname, 'init' );
	}

	/**
	 * Define classes.
	 *
	 * @return mixed
	 */
	abstract protected function define();

	/**
	 * Register classes provided by the service provider.
	 *
	 * @return void
	 */
	public function register() {
		foreach ( $this->services_to_load as $registration ) {
			$registration->register( $this->getLeagueContainer() );
		}
	}

	/**
	 * Loads definitions.
	 *
	 * @return void
	 */
	protected function load() {
		if ( $this->loaded ) {
			return;
		}

		$this->loaded = true;
		$this->define();
	}

	/**
	 * Fetch subscribers by type.
	 *
	 * @param string $type Type of subscriber.
	 * @return array
	 */
	protected function fetch_subscribers_by_type( string $type ): array {
		$subscribers = [];

		foreach ( $this->services_to_load as $service ) {
			if ( ! $service instanceof SubscriberRegistration ) {
				continue;
			}

			if ( $type !== $service->get_type() ) {
				continue;
			}

			$subscribers [] = $service->get_id();
		}

		return $subscribers;
	}
}
