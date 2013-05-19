<?php
namespace Ace\Schedule\Item;
use Ace\Schedule\IValue;
use Ace\Schedule\IMatcher;
use Ace\Schedule\Exception;

class Minute implements IMatcher {
    /**
    * @var IValue
    */
	protected $minutes;

	public function __construct(IValue $minutes){
        if ($minutes->lessThan(0) || $minutes->greaterThan(59)){
            throw new Exception("Minute value must be between 0 and 59");
        }
		$this->minutes = $minutes;
	}

	public function matches(\DateTime $date_time){
		return $this->minutes->contains(intval($date_time->format('i')));
	}
}
