<?php

namespace LaunchpadCore\EventManagement\Wrapper;

use LaunchpadCore\EventManagement\ClassicSubscriberInterface;
use LaunchpadCore\EventManagement\OptimizedSubscriberInterface;
use League\Container\Container;
use ReflectionClass;

class SubscriberWrapper
{

    protected $prefix = '';

    /**
     * @var Container
     */
    protected $container;

    /**
     * @param string $prefix
     */
    public function __construct(string $prefix, Container $container)
    {
        $this->prefix = $prefix;
        $this->container = $container;
    }

    public function wrap(string $object): ClassicSubscriberInterface
    {
        $interfaces = class_implements($object);
        if($interfaces && in_array(OptimizedSubscriberInterface::class, $interfaces)) {
            $events = $object::get_subscribed_events();
            return new WrappedClassicSubscriber($object, $events);
        }

        if($interfaces && in_array(ClassicSubscriberInterface::class, $interfaces)) {
            return $this->container->get($object);
        }

        $methods = get_class_methods($object);
        $reflectionClass = new ReflectionClass($object);
        $events = [];
        foreach ($methods as $method) {
            $method_reflection = $reflectionClass->getMethod($method);
            $doc_comment = $method_reflection->getDocComment();
            if ( ! $doc_comment ) {
                continue;
            }
            $pattern = "#@hook\s(?<name>[a-zA-Z\\\-_$/]+)(\s(?<priority>[0-9]+))?#";

            preg_match_all($pattern, $doc_comment, $matches, PREG_PATTERN_ORDER);
            if(! $matches) {
                continue;
            }

            foreach ($matches[0] as $index => $match) {
                $hook = str_replace('$prefix', $this->prefix, $matches['name'][$index]);

                $events[$hook][] = [
                    $method,
                    key_exists('priority', $matches) && key_exists($index, $matches['priority']) && $matches['priority'][$index] !== "" ? (int) $matches['priority'][$index] : 10,
                    $method_reflection->getNumberOfParameters(),
                ];
            }
        }

        return new WrappedClassicSubscriber($object, $events);
    }
}