<?php
namespace Ace\Schedule\Item;
use Ace\Schedule\iValue;
use Ace\Schedule\iMatcher;

class Day implements iMatcher {
	protected $day;

	public function __construct(iValue $day){
		$this->day = $day;
	}

	public function matches(\DateTime $date_time){
		return $this->day->contains(intval($date_time->format('j')));
	}
}
