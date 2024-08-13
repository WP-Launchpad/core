<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\autowiring\inc;

use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Container\Registration\Registration;
use LaunchpadCore\Deactivation\HasDeactivatorServiceProviderInterface;
use LaunchpadCore\Deactivation\HasDeactivatorServiceProviderTrait;
use League\Container\Definition\Definition;

class DeactivateServiceProvider extends AbstractServiceProvider implements HasDeactivatorServiceProviderInterface
{
    use HasDeactivatorServiceProviderTrait;
    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_deactivator(Deactivator::class)->autowire();
    }
}