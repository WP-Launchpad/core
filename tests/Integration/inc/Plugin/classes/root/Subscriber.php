<?php

namespace LaunchpadCore\Tests\Integration\inc\Plugin\classes\root;

use LaunchpadCore\EventManagement\SubscriberInterface;

class Subscriber implements SubscriberInterface
{
    /**
     * @hook root_hook
     */
    public function root_callback()
    {

    }
}