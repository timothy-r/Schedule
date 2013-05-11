<?php
namespace Ace\Schedule\Item;
use Ace\Schedule\iValue;
use Ace\Schedule\iMatcher;
use Ace\Schedule\Exception;

class Day implements iMatcher {
	protected $day;

	public function __construct(iValue $day){
        if ($day->min() < 0 || $day->max() > 31){
            throw new Exception('Day value must be between 0 and 31');
        }
		$this->day = $day;
	}

	public function matches(\DateTime $date_time){
		return $this->day->contains(intval($date_time->format('j')));
	}
}
