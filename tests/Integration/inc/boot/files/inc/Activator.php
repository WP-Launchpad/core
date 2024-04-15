<?php

namespace LaunchpadCore\Tests\Integration\inc\boot\files\inc;

use LaunchpadCore\Activation\ActivationInterface;

class Activator implements ActivationInterface
{

    /**
     * @inheritDoc
     */
    public function activate()
    {
        update_option('demo_option', true);
    }
}