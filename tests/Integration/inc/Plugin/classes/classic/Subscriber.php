<?php

namespace LaunchpadCore\Tests\Integration\inc\Plugin\classes\classic;

use LaunchpadCore\EventManagement\ClassicSubscriberInterface;

class Subscriber implements ClassicSubscriberInterface
{

    public function get_subscribed_events()
    {
        return [
            'classic_hook' => 'callback'
        ];
    }

    public function callback()
    {

    }
}