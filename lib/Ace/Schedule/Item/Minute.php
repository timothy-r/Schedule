<?php
namespace Ace\Schedule\Item;
use Ace\Schedule\ValueInterface;
use Ace\Schedule\MatcherInterface;
use Ace\Schedule\Exception;

class Minute implements MatcherInterface {
    /**
    * @var ValueInterface
    */
	private $minutes;

	public function __construct(ValueInterface $minutes){
        if ($minutes->lessThan(0) || $minutes->greaterThan(59)){
            throw new Exception("Minute value must be between 0 and 59");
        }
		$this->minutes = $minutes;
	}

	public function matches(\DateTime $date_time){
		return $this->minutes->contains(intval($date_time->format('i')));
	}
}
