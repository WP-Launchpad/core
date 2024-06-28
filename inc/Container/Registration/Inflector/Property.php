<?php

namespace LaunchpadCore\Container\Registration\Inflector;

class Property
{
    /**
     * @var string
     */
    protected $name = '';

    protected $value;

    /**
     * @param string $name
     * @param $value
     */
    public function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function get_name(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function get_value()
    {
        return $this->value;
    }

}