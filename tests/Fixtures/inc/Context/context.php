<?php
return [
	'regular' => [
		'config' => [
			'plugin' => __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'plugin.php',
			'event' => 'my_event',
			],
		'expected' => [
			'class_context' => false,
			'subscriber_logic' => false,
			'method_context' => true,
		]
	],
	'class' => [
		'config' => [
			'plugin' => __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'plugin.php',
			'event' => 'my_class_event',
		],
		'expected' => [
			'class_context' => true,
			'subscriber_logic' => false,
			'method_context' => false,
		]
	],
];