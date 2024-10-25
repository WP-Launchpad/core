<?php

namespace LaunchpadCore\Tests\Integration\inc\Plugin\classes\optimize;

use LaunchpadCore\EventManagement\OptimizedSubscriberInterface;

class Subscriber implements OptimizedSubscriberInterface
{

    public static function get_subscribed_events()
    {
        return [
            'optimize_hook' => 'optimize_callback'
        ];
    }

    public function optimize_callback()
    {

    }
}