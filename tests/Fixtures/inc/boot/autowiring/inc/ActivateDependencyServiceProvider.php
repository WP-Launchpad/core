<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\autowiring\inc;

use LaunchpadCore\Activation\ActivationServiceProviderInterface;
use LaunchpadCore\Container\AbstractServiceProvider;

class ActivateDependencyServiceProvider extends AbstractServiceProvider implements ActivationServiceProviderInterface
{

    /**
     * @inheritDoc
     */
    protected function define()
    {
       $this->register_service(ActivateDependency::class);
    }
}