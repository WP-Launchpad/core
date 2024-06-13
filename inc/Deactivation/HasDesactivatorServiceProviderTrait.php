<?php

namespace LaunchpadCore\Deactivation;

use LaunchpadCore\Container\Registration\DeactivatorRegistration;
use LaunchpadCore\Container\Registration\Registration;

trait HasDesactivatorServiceProviderTrait
{
    /**
     * Returns list of deactivators.
     *
     * @return string[]
     */
    public function get_deactivators(): array {
        $this->load();

        $deasactivators = [];

        foreach ($this->get_services_to_load() as $registration) {
            if(! $registration instanceof DeactivatorRegistration) {
                continue;
            }

            $deasactivators []= $registration->get_id();
        }

        return $deasactivators;
    }

    /**
     * Loads definitions.
     *
     * @return void
     */
    abstract protected function load();

    /**
     * @return Registration[]
     */
    abstract protected function get_services_to_load(): array;

    abstract protected function add_service_to_load(Registration $registration): void;
}