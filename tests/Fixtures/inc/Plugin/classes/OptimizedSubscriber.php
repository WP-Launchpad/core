<?php

namespace LaunchpadCore\Tests\Fixtures\inc\Plugin\classes;

use LaunchpadCore\EventManagement\OptimizedSubscriberInterface;

class OptimizedSubscriber implements OptimizedSubscriberInterface
{

    public static function get_subscribed_events()
    {
        return [];
    }
}
