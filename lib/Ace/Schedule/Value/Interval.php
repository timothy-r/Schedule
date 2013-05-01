<?php
namespace Ace\Schedule\Value;
use Ace\Schedule\iValue;

class Interval implements iValue {
	protected $range;
	protected $interval;

	public function __construct(Range $range, $interval){
		$this->range = $range;
		$this->interval = intval($interval);
	}

	/**
	* eg 2-46/2 for minutes indicates every 2 mins between 2 and 46
	* starting at 4 (2+2)
	*/
	public function contains($value) {
		$value = intval($value);
		if ($this->range->contains($value)){	
			// inside the range, test if matches the interval
			return 0 == ($value % $this->interval);
		}
		return false;
	}
}
