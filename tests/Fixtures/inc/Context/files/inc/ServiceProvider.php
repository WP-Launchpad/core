<?php

namespace LaunchpadCore\Tests\Fixtures\inc\Context\files\inc;

use LaunchpadCore\Container\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider {

	/**
	 * @inheritDoc
	 */
	protected function define() {
		$this->register_service(Context::class);
		$this->register_service(ClassContext::class);
		$this->register_common_subscriber(Subscriber::class);
		$this->register_common_subscriber(ClassContextSubscriber::class);
	}
}