<?php
namespace Crystal\NepaliDate;
use Zend\ServiceManager\Factory\InvokableFactory;

return [

	'controller_plugins' => [
		'factories' => [
			Controller\Plugin\NepaliDateConverter::class => Controller\Plugin\Factory\NepaliDateConverterFactory::class,
		],
		'aliases' => [
			'NepaliDateConverter' => Controller\Plugin\NepaliDateConverter::class,
			'nepaliDateConverter' => Controller\Plugin\NepaliDateConverter::class,
		],
	],
	'view_helpers' => [
		'factories' => [
			View\Helper\NepaliDateConverter::class => View\Helper\Factory\NepaliDateConverterFactory::class,
		],
		'aliases' => [
			'NepaliDateConverter' => View\Helper\NepaliDateConverter::class,
			'nepaliDateConverter' => View\Helper\NepaliDateConverter::class,
		],

	],
	'service_manager' => [
		'factories' => [
			Service\NepaliDateConverter::class => InvokableFactory::class,
		],

	],

];
