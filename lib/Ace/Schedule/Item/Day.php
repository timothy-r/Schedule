<?php
namespace Ace\Schedule\Item;
use Ace\Schedule\ValueInterface;
use Ace\Schedule\MatcherInterface;
use Ace\Schedule\Exception;
use DateTime;

class Day implements MatcherInterface {
	private $day;

	public function __construct(ValueInterface $day){
        if ($day->lessThan(0) || $day->greaterThan(31)){
            throw new Exception('Day value must be between 0 and 31');
        }
		$this->day = $day;
	}

	public function matches(DateTime $date_time){
		return $this->day->contains(intval($date_time->format('j')));
	}
}
