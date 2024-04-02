<?php

namespace LaunchpadCore\Tests\Fixtures\inc\Plugin\classes;

use LaunchpadCore\EventManagement\ClassicSubscriberInterface;

class ClassicSubscriber implements ClassicSubscriberInterface
{

    public function get_subscribed_events()
    {
        return [];
    }
}