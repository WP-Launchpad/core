<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\autowiring\inc;

use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Deactivation\HasDeactivatorServiceProviderInterface;
use LaunchpadCore\Deactivation\HasDesactivatorServiceProviderTrait;

class AnnotationDeactivatorServiceProvider extends AbstractServiceProvider implements HasDeactivatorServiceProviderInterface {

	use HasDesactivatorServiceProviderTrait;
	/**
	 * @inheritDoc
	 */
	protected function define() {
		$this->register_deactivator(AnnotationDeactivator::class);
	}
}