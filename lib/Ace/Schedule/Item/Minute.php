<?php
namespace Ace\Schedule\Item;
use Ace\Schedule\iValue;
use Ace\Schedule\iMatcher;
use Ace\Schedule\Exception;

class Minute implements iMatcher {
    /**
    * @var iValue
    */
	protected $minutes;

	public function __construct(iValue $minutes){
        if ($minutes->min() < 0 || $minutes->max() > 59){
            throw new Exception;
        }
		$this->minutes = $minutes;
	}

	public function matches(\DateTime $date_time){
		return $this->minutes->contains(intval($date_time->format('i')));
	}
}
