<?php

namespace LaunchpadCore\Tests\Integration\inc\Plugin\classes\optimized;

use LaunchpadCore\EventManagement\OptimizedSubscriberInterface;

class Subscriber implements OptimizedSubscriberInterface
{

    /**
     * @inheritDoc
     */
    public static function get_subscribed_events()
    {
        return [
            'optimized_hook' => 'callback'
        ];
    }

    public function callback()
    {

    }
}