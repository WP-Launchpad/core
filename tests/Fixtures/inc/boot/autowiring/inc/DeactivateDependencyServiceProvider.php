<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\autowiring\inc;

use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Deactivation\DeactivationServiceProviderInterface;

class DeactivateDependencyServiceProvider extends AbstractServiceProvider implements DeactivationServiceProviderInterface
{

    protected function define()
    {
        $this->register_service(DeactivateDependency::class);
    }
}