<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\autowiring\inc;

use LaunchpadCore\Container\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{
    protected function define()
    {
        $this->register_common_subscriber(Subscriber::class)->is_autowire();

        $this->register_common_subscriber(RegularSubscriber::class);
    }
}