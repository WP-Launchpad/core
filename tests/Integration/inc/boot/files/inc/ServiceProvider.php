<?php

namespace LaunchpadCore\Tests\Integration\inc\boot\files\inc;

use LaunchpadCore\Container\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{

    public function get_common_subscribers(): array
    {
        return [
            Subscriber::class
        ];
    }

    protected function define()
    {
        $this->register_service(Subscriber::class);
    }
}