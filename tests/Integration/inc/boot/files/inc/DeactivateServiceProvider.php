<?php

namespace LaunchpadCore\Tests\Integration\inc\boot\files\inc;

use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Deactivation\HasDeactivatorServiceProviderInterface;

class DeactivateServiceProvider extends AbstractServiceProvider implements HasDeactivatorServiceProviderInterface
{

    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_service(Deactivator::class);
    }

    /**
     * @inheritDoc
     */
    public function get_deactivators(): array
    {
        return [
            Deactivator::class
        ];
    }
}