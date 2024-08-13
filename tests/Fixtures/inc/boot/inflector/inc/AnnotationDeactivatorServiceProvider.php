<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\inflector\inc;

use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Deactivation\HasDeactivatorServiceProviderInterface;
use LaunchpadCore\Deactivation\HasDeactivatorServiceProviderTrait;

class AnnotationDeactivatorServiceProvider extends AbstractServiceProvider implements HasDeactivatorServiceProviderInterface {

	use HasDeactivatorServiceProviderTrait;
	/**
	 * @inheritDoc
	 */
	protected function define() {
		$this->register_deactivator(AnnotationDeactivator::class);
	}
}