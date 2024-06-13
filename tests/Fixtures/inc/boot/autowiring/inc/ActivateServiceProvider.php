<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\autowiring\inc;

use LaunchpadCore\Activation\ActivationServiceProviderInterface;
use LaunchpadCore\Activation\HasActivatorServiceProviderInterface;
use LaunchpadCore\Activation\HasActivatorServiceProviderTrait;
use LaunchpadCore\Container\AbstractServiceProvider;

class ActivateServiceProvider extends AbstractServiceProvider implements HasActivatorServiceProviderInterface
{
    use HasActivatorServiceProviderTrait;
    /**
     * @inheritDoc
     */
    protected function define()
    {
       $this->register_activator(Activator::class);
    }
}