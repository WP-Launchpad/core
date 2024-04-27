<?php

namespace LaunchpadCore\Tests\Integration\inc\Container\PrefixAwareInterface;

use LaunchpadCore\Tests\Integration\inc\Container\PrefixAwareInterface\classes\PrefixAwareClass;
use LaunchpadCore\Tests\Integration\inc\Container\PrefixAwareInterface\classes\ServiceProvider;
use LaunchpadCore\Tests\Integration\inc\Traits\SetupPluginTrait;
use LaunchpadCore\Tests\Integration\TestCase;

/**
 * @covers \LaunchpadCore\Container\PrefixAwareInterface::set_prefix
 */
class Test_setPrefix extends TestCase {
    use SetupPluginTrait;

    public function testShouldDoAsExpected()
    {
        $prefix = 'test';

        $this->setup_plugin($prefix, [
            ServiceProvider::class
        ]);

        $this->assertSame($prefix, $this->container->get(PrefixAwareClass::class)->get_prefix());
    }
}
