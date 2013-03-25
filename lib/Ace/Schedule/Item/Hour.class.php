<?php
namespace Ace\Schedule\Item;
use Ace\Schedule\Value\iValue;

class Hour implements iMatcher {
	protected $hour;

	public function __construct(iValue $hour){
		$this->hour = $hour;
	}

	public function matches(\DateTime $date_time){
		return $this->hour->contains(intval($date_time->format('G')));
	}
}
