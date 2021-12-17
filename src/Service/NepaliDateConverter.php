<?php
namespace Crystal\NepaliDate\Service;
use Crystal\NepaliDate\NepaliDate;
use \Exception;

class NepaliDateConverter {

	private $_nepali_date = array('year' => 0, 'month' => 0, 'day' => 0, 'date' => 0);

	private $_english_date = '';

	private $_converter = '';

	public function __construct() {
		$this->_english_date = date('Y-m-d');
		$this->_converter = new NepaliDate();
		$arr = $this->toArray($this->_english_date);
		$nepali_date = $this->_converter->eng_to_nep($arr['year'], $arr['month'], $arr['date']);
		$this->_nepali_date = $nepali_date;
	}

	public static function toArray($str) {
		if ($str == '') {
			throw new Exception('$str must be string with - as delimiter');
		}
		$temp = explode('-', $str);
		return array('year' => $temp[0], 'month' => $temp[1], 'date' => $temp[2], 'day' => 0);
	}

	public static function toStr($arr) {
		if (!is_array($arr)) {
			throw new Exception('$arr must be an array.');
		}
		return $arr['year'] . '-' . $arr['month'] . '-' . $arr['date'];
	}

	public static function createFromNepaliDate($nepali_date) {
		if (is_string($nepali_date)) {
			$nepali_date = self::toArray($nepali_date);
		}
		$converter = new NepaliDate();
		$instance = new self();
		$instance->setNepaliDate($nepali_date);
		$eng = $converter->nep_to_eng($nepali_date['year'], $nepali_date['month'], $nepali_date['date']);
		$instance->setEnglishDate(self::toStr($eng));
		return $instance;

		// now create English date from Nepali date
	}

	public static function createFromEnglishDate($english_date) {
		if (is_array($english_date)) {
			$str = self::toStr($english_date);
			$english_date = $str;
		}
		$instance = new self();
		$instance->setEnglishDate($english_date);
		// now find equivalent nepali date and calculate
		$converter = new NepaliDate();

		$arr = self::toArray($english_date);
		$instance->setNepaliDate($converter->eng_to_nep($arr['year'], $arr['month'], $arr['date']));
		return $instance;
	}

	public function getLastDateOfFiscalYear($year) {
		$new_year = $year + 1;
		return ($new_year) . '-03-' . $this->getLastDayOfMonth($new_year, 3);
	}

	public function getFiscalYear($date = null) {
		if ($date == null) {
			$date = date('Y-m-d');
		}
		$nepali_date = $this->toNepaliDate($date, true);
		if ($nepali_date['month'] < 4) {
			return $nepali_date['year'] - 1;
		}
		return $nepali_date['year'];
	}

	public function toNepaliDate($english_date = null, $array = false, $unicode = false) {
		$nep = $this->_nepali_date;
		if ($english_date != null) {
			// here do the conversion to nepali date
			$arr = $this->toArray($english_date);
			$nep = $this->_converter->eng_to_nep($arr['year'], $arr['month'], $arr['date']);
		}
		if (!$array) {
			if ($unicode) {
				return $nep['np_day'] . ', ' . $nep['np_date'] . ', ' . $nep['np_month'] . ', ' . $nep['np_year'];
			}
			return $this->toStr($nep);
		}
		return $nep;
	}

	public function toEnglishDate($nepali_date = null, $array = false) {
		$eng = $this->_english_date;
		if ($nepali_date != null) {
			$arr = $this->toArray($nepali_date);
			$eng = $this->_converter->nep_to_eng($arr['year'], $arr['month'], $arr['date']);
		}
		if (!$array) {
			return $this->toStr($eng);
		}
		return $eng;
	}

	public function getNepaliDate($array = false) {
		if ($array) {
			return $this->_nepali_date;
		}
		return $this->toStr($this->_nepali_date);
	}

	public function setNepaliDate($nepali_date) {
		if (is_string($nepali_date)) {
			$nepali_date = $this->toArray($nepali_date);
		}
		$this->_nepali_date = $nepali_date;
	}

	public function getEnglishDate() {
		return $this->_english_date;
	}

	public function isLastDayOfMonth($year, $month, $day) {
		if ($day == $this->getLastDayOfMonth($year, $month)) {
			return true;
		}
		return false;
	}

	public function getLastDayOfMonth($year, $month) {
		return $this->_converter->get_last_day_of_month_nep($year, $month);
	}

	public function setEnglishDate($english_date) {
		if (!is_string($english_date)) {
			throw new Exception('String must be provided.');
		}
		$this->_english_date = $english_date;
	}

	public function __toString() {}
}
