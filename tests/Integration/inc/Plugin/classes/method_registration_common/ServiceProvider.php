<?php

namespace LaunchpadCore\Tests\Integration\inc\Plugin\classes\method_registration_common;

use LaunchpadCore\Container\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{

    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_common_subscriber(Subscriber::class);
    }
}