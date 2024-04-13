<?php

namespace LaunchpadCore\Dispatcher;

use LaunchpadDispatcher\Dispatcher;

interface DispatcherAwareInterface {

	/**
	 * Setup WordPress hooks dispatcher.
	 *
	 * @param Dispatcher $dispatcher WordPress hooks dispatcher.
	 *
	 * @return void
	 */
	public function set_dispatcher( Dispatcher $dispatcher ): void;
}
