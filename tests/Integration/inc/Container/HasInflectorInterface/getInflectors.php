<?php

namespace LaunchpadCore\Tests\Integration\inc\Container\HasInflectorInterface;

use LaunchpadCore\EventManagement\EventManager;
use LaunchpadCore\EventManagement\Wrapper\SubscriberWrapper;
use LaunchpadCore\Plugin;
use LaunchpadCore\Tests\Integration\inc\Container\HasInflectorInterface\classes\Inflected;
use LaunchpadCore\Tests\Integration\inc\Container\HasInflectorInterface\classes\InflectorAware;
use LaunchpadCore\Tests\Integration\inc\Container\HasInflectorInterface\classes\ServiceProvider;
use LaunchpadCore\Tests\Integration\inc\Traits\SetupPluginTrait;
use LaunchpadCore\Tests\Integration\TestCase;
use League\Container\Container;

/**
 * @covers \LaunchpadCore\Container\HasInflectorInterface::get_inflectors
 */
class Test_getInflectors extends TestCase {

    use SetupPluginTrait;

    public function testShouldDoAsExpected()
    {

        $prefix = 'test';

        $this->setup_plugin($prefix, [
            ServiceProvider::class
        ]);

        $this->assertInstanceOf(Inflected::class, $this->container->get(InflectorAware::class)->get_inflector());
    }
}
