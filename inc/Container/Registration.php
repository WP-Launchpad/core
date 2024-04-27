<?php

namespace LaunchpadCore\Container;

use League\Container\Container;
use League\Container\Definition\DefinitionInterface;

class Registration
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var callable|null
     */
    protected $definition;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var bool
     */
    protected $shared = false;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
        $this->value = $id;
    }

    /**
     * @param callable(DefinitionInterface $class_definition): void|null $definition
     * @return $this
     */
    public function set_definition(callable $definition): Registration
    {
        $this->definition = $definition;
        return $this;
    }

    public function set_concrete($concrete): Registration
    {
        $this->value = $concrete;
        return $this;
    }

    public function share(): Registration
    {
        $this->shared = true;
        return $this;
    }

    public function register(Container $container)
    {
        $class_registration = $container->add($this->id, $this->value, $this->shared);

        if( ! $this->definition ) {
            return;
        }

        $this->definition($class_registration);
    }
}