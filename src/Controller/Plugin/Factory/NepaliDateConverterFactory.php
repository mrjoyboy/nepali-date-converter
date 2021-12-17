<?php
namespace Crystal\NepaliDate\Controller\Plugin\Factory;

use Crystal\NepaliDate\Controller\Plugin\NepaliDateConverter;
use Crystal\NepaliDate\Service\NepaliDateConverter as NepaliDateConverterService;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class NepaliDateConverterFactory implements FactoryInterface {
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {

		$converter = $container->get(NepaliDateConverterService::class);
		return new NepaliDateConverter($converter);
	}
}
