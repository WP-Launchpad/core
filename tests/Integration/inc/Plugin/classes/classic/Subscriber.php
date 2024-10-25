<?php

namespace LaunchpadCore\Tests\Integration\inc\Plugin\classes\classic;

use LaunchpadCore\EventManagement\ClassicSubscriberInterface;

class Subscriber implements ClassicSubscriberInterface
{

    /**
     * @inheritDoc
     */
    public function get_subscribed_events()
    {
        return [
            'classic_hook' => 'classic_callback'
        ];
    }

    public function classic_callback()
    {

    }
}