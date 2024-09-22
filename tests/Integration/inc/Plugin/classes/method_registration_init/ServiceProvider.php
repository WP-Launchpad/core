<?php

namespace LaunchpadCore\Tests\Integration\inc\Plugin\classes\method_registration_init;

use LaunchpadCore\Container\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{

    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_init_subscriber(Subscriber::class);
    }
}