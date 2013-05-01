<?php
namespace Ace\Schedule\Item;
use Ace\Schedule\iValue;
use Ace\Schedule\iMatcher;
use DateTime;

class WeekDay implements iMatcher {
	protected $week_day;

	public function __construct(iValue $week_day){
		$this->week_day = $week_day;
	}

	public function matches(DateTime $date_time){
		return $this->week_day->contains(intval($date_time->format('w')));
	}
}
