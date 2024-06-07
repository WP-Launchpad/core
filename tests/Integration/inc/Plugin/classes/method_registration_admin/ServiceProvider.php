<?php

namespace LaunchpadCore\Tests\Integration\inc\Plugin\classes\method_registration_admin;

use LaunchpadCore\Container\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{

    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_admin_subscriber(Subscriber::class);
    }
}