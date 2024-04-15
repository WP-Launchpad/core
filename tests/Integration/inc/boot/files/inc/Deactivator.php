<?php

namespace LaunchpadCore\Tests\Integration\inc\boot\files\inc;

use LaunchpadCore\Deactivation\DeactivationInterface;

class Deactivator implements DeactivationInterface
{

    /**
     * @inheritDoc
     */
    public function deactivate()
    {
        delete_option('demo_option');
    }
}