<?php
namespace Ace\Schedule\Item;
use Ace\Schedule\iValue;
use Ace\Schedule\iMatcher;
use Ace\Schedule\Exception;

class Hour implements iMatcher {
	protected $hour;

	public function __construct(iValue $hour){
        if ($hour->min() < 0 || $hour->max() > 23){
            throw new Exception("Hour value must be between 0 and 23");
        }
		$this->hour = $hour;
	}

	public function matches(\DateTime $date_time){
		return $this->hour->contains(intval($date_time->format('G')));
	}
}
