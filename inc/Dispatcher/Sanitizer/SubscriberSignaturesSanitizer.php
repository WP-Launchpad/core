<?php

namespace LaunchpadCore\Dispatcher\Sanitizer;

use LaunchpadCore\Container\ServiceProviderInterface;
use LaunchpadCore\EventManagement\SubscriberInterface;
use LaunchpadDispatcher\Interfaces\SanitizerInterface;

class SubscriberSignaturesSanitizer implements SanitizerInterface
{

    protected $is_default = false;

    public function sanitize($value)
    {
        $this->is_default = false;

        if( ! is_array($value)) {
            $this->is_default = true;
            return false;
        }

        $output = [];

        foreach ($value as $subscriber) {
            if ( ! is_string($subscriber) && ! is_object($subscriber) ) {
                continue;
            }

            $output []= $subscriber;
        }

        return $output;
    }

    public function is_default($value, $original): bool
    {
        return $this->is_default;
    }
}