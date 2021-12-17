<?php
namespace Crystal\NepaliDate\View\Helper;

use Crystal\NepaliDate\Service\NepaliDateConverter as ConverterService;
use Zend\View\Helper\AbstractHelper;

class NepaliDateConverter extends AbstractHelper {
	protected $nepaliDateConverter = null;
	public function __construct(ConverterService $nepaliDateConverter) {
		$this->nepaliDateConverter = $nepaliDateConverter;
	}
	public function __invoke() {
		return $this->nepaliDateConverter;
	}

}