<?php
namespace Ace\Schedule\Value;

/**
* contains a range of continuous values inclusive of boundaries
*/
class Range implements iValue {
	protected $low;
	protected $high;

	public function __construct($low, $high){
		$this->low = intval($low);
		$this->high = intval($high);
	}

	public function getStart() {
		return $this->low;
	}

	public function contains($value) {
		$value = intval($value);
		return (($value >= $this->low) && ($value <= $this->high));
	}
}
