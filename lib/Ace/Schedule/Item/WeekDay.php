<?php
namespace Ace\Schedule\Item;
use Ace\Schedule\iValue;
use Ace\Schedule\iMatcher;
use Ace\Schedule\Exception;
use DateTime;

class WeekDay implements iMatcher {
	protected $week_day;

	public function __construct(iValue $week_day){;
        if ($week_day->lessThan(0) || $week_day->greaterThan(6)){
            throw new Exception('WeekDay value must be between 0 and 6');
        }
		$this->week_day = $week_day;
	}

	public function matches(DateTime $date_time){
		return $this->week_day->contains(intval($date_time->format('w')));
	}
}
