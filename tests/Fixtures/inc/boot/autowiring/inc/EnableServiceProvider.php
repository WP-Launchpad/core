<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\autowiring\inc;

use LaunchpadCore\Activation\HasActivatorServiceProviderInterface;
use LaunchpadCore\Container\AbstractServiceProvider;
use League\Container\Definition\Definition;

class EnableServiceProvider extends AbstractServiceProvider implements HasActivatorServiceProviderInterface
{

    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_service(Activator::class, function (Definition $definition) {
           $definition->addArgument(ActivateDependency::class);
        });
    }

    public function get_activators(): array
    {
        return [
            Activator::class
        ];
    }
}