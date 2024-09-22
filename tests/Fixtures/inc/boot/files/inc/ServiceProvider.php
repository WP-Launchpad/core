<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\files\inc;

use LaunchpadCore\Container\AbstractServiceProvider;
use League\Container\Definition\Definition;

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
        $this->register_service(Subscriber::class)
            ->set_definition(function (Definition $definition) {
                $definition->addArgument($definition->addArguments(['key_param', 'cache']));
            });
    }
}