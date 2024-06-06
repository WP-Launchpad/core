<?php

namespace LaunchpadCore\Container\Registration;

use LaunchpadCore\Container\Registration\Registration;

class SubscriberRegistration extends Registration
{
    /**
     * Type of subscriber.
     *
     * @var string
     */
    protected $type;

    /**
     * Instantiate the class.
     *
     * @param string $type
     */
    public function __construct(string $id, string $type)
    {
        parent::__construct( $id );
        $this->type = $type;
    }

    /**
     * Get the type of subscriber.
     * @return string
     */
    public function get_type(): string
    {
        return $this->type;
    }
}