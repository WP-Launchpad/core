<?php

namespace LaunchpadCore\Tests\Integration\inc\Plugin\classes\method_registration_front;

use LaunchpadCore\Container\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{

    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_front_subscriber(Subscriber::class);
    }
}