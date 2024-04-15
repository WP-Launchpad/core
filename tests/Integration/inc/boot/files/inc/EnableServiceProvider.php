<?php

namespace LaunchpadCore\Tests\Integration\inc\boot\files\inc;

use LaunchpadCore\Activation\HasActivatorServiceProviderInterface;
use LaunchpadCore\Container\AbstractServiceProvider;

class EnableServiceProvider extends AbstractServiceProvider implements HasActivatorServiceProviderInterface
{

    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_service(Activator::class);
    }

    public function get_activators(): array
    {
        return [
            Activator::class
        ];
    }
}