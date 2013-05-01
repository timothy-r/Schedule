<?php
namespace Ace\Schedule\Item;
use Ace\Schedule\iValue;
use Ace\Schedule\iMatcher;

class Minute implements iMatcher {
	protected $minutes;

	public function __construct(iValue $minutes){
		$this->minutes = $minutes;
	}

	public function matches(\DateTime $date_time){
		return $this->minutes->contains(intval($date_time->format('i')));
	}
}
