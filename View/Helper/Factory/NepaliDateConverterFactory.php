<?php
namespace Crystal\NepaliDate\View\Helper\Factory;

use Crystal\NepaliDate\Service\NepaliDateConverter as NepaliDateConverterService;
use Crystal\NepaliDate\View\Helper\NepaliDateConverter;

class NepaliDateConverterFactory implements FactoryInterface {
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {

		$nepaliDateConverterService = $container->get(NepaliDateConverterService::class);
		return new NepaliDateConverter($nepaliDateConverterService);
	}
}
