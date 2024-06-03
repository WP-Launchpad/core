<?php

namespace LaunchpadCore\Container\Registration;

use LaunchpadCore\Container\Registration\Registration;

class SubscriberRegistration extends Registration
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @param string $type
     */
    public function __construct(string $id, string $type)
    {
        parent::__construct( $id );
        $this->type = $type;
    }

    public function get_type(): string
    {
        return $this->type;
    }
}