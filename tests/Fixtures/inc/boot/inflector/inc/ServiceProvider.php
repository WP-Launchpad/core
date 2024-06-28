<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\inflector\inc;

use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Container\HasInflectorInterface;
use LaunchpadCore\Container\InflectorServiceProviderTrait;
use LaunchpadCore\Tests\Fixtures\inc\boot\inflector\inc\Inflector\Inflected;
use LaunchpadCore\Tests\Fixtures\inc\boot\inflector\inc\Inflector\InflectorInterface;

class ServiceProvider extends AbstractServiceProvider implements HasInflectorInterface
{
    use InflectorServiceProviderTrait;

    public function get_common_subscribers(): array
    {
        return [
            Subscriber::class
        ];
    }

    protected function define()
    {
        $this->register_service(Inflected::class);
        $this->register_service(Subscriber::class);
        $this->register_inflector(InflectorInterface::class)
            ->add_method('inflector_method', [
                Inflected::class
            ]);
    }
}