<?php
namespace Crystal\NepaliDate\Controller\Plugin;
use Crystal\NepaliDate\Service\NepaliDateConverter as ConverterService;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class NepaliDateConverter extends AbstractPlugin {
	protected $dateConverver;
	public function __construct(ConverterService $dateConverver) {
		$this->dateConverver = $dateConverver;
	}
	public function __invoke() {
		return $this->dateConverver;
	}
}